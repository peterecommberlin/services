<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Jobs\CompanyRepresentativesJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;


use Eventjuicer\Repositories\CompanyRepresentativeRepository;
use Eventjuicer\Repositories\Criteria\ColumnGreaterThanZero;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;
use Eventjuicer\Services\Personalizer;


use Eventjuicer\ValueObjects\EmailAddress;


/*

changes
===========================
use event_manager as CC contact
handle language differently

*/

class CompanyRepresentatives extends Command
{

 
    protected $signature = 'exhibitors:reps {host} {--lang=}';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(
            GetByRole $getByRole, 
            CompanyData $cd, 
            ParticipantSendable $sendable, 
            CompanyRepresentativeRepository $repo
    ){

        $route = new Resolver( $this->argument("host") );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $exhibitors = $getByRole->get($eventId, "exhibitor", ["company.data"])->unique("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $sendable->checkUniqueness(true);

        $filtered = $sendable->filter($exhibitors, $eventId);

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $done = 0;

        /*get representatives*/

        $repo->pushCriteria( new BelongsToEvent($eventId));
        $repo->pushCriteria( new ColumnGreaterThanZero("parent_id") );
        $repo->with(["fields", "purchases"]);
        $reps = $repo->all();


        $reps = $reps->filter(function($participant){

            return $participant->purchases->first()->status !== "cancelled";

        })->groupBy("company_id");

        /*get representatives*/

        $this->info("Reps found: " . $reps->count() );

        $whatWeDo  = $this->anticipate('Send, stats, empty?', ['send', 'stats', 'empty']);


        foreach($exhibitors as $ex)
        {   

            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }
            
            $companyProfile = $cd->toArray($ex->company);

            $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : "en";

            $name = !empty($companyProfile["name"]) ? $companyProfile["name"] : $ex->slug;

            $cReps = array_get($reps, $ex->company_id, collect([]))->mapInto(Personalizer::class);

            if($whatWeDo === "empty"){

                if(!$cReps->count()){
                    $this->error("No reps " . $name . " lang: " . $lang);
                }

                continue;
            }

            $this->line("Processing " . $name . " lang: " . $lang);

            $this->info("Reps: " . $cReps->count());
          
            if($lang !== $this->option("lang"))
            {
                $this->info("Skipped! Lang mismatch. ");
                //continue;
            }

            $event_manager = (new EmailAddress($companyProfile["event_manager"]))->find();


            if($whatWeDo === "send")
            {
                $this->info("Notifying " . $ex->email);

                dispatch(new Job($ex, $cReps, $eventId, $lang, $event_manager));
            }

            $done++;

        }   

        $this->info("Counted " . $done . " companies with errors...");


    }
}
