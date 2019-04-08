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

 
    protected $signature = 'exhibitors:reps 
        {--domain=} 
        {--email=} 
        {--subject=}
        {--min=}
        {--lang=}
        {--defaultlang=}';

    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(
            GetByRole $getByRole, 
            CompanyData $cd, 
            ParticipantSendable $sendable, 
            CompanyRepresentativeRepository $repsRepo
    ){


        $errors = [];


        $viewlang   = $this->option("lang");
        $defaultlang= $this->option("defaultlang");

        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");
        $min        = $this->option("min");



        if(empty($viewlang)) {
            $errors[] = "--lang= must be set!";
        }

        if(empty($defaultlang)) {
            $errors[] = "--defaultlang= must be set!";
        }

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($subject)) {
            $errors[] = "--subject= must be set!";
        }
    
        
        if(empty($email)) {
            $errors[] = "--email= must be set!";
        }

        if(empty($min)) {
            $errors[] = "--min= must be set!";
        }

        if(! view()->exists("emails.company." . $email . "-" . $viewlang)) {
            $errors[] = "--email= error. View cannot be found!";
        }


        if(count($errors)){

            foreach($errors as $error){
                $this->error($error);
            }

            return;
        }



        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $exhibitors = $getByRole->get($eventId, "exhibitor", ["company.data"])->unique("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $sendable->checkUniqueness(false);

        $sendable->setMuteTime(20); //minutes!!!!


        $filtered = $sendable->filter($exhibitors, $eventId);


        $this->info("Exhibitors that can be notified: " . $filtered->count() );


        $done = 0;

        /*get representatives*/

        $repsRepo->pushCriteria( new BelongsToEvent($eventId));
        $repsRepo->pushCriteria( new ColumnGreaterThanZero("parent_id") );
        $repsRepo->with(["fields", "purchases"]);
        $reps = $repsRepo->all();


        $reps = $reps->filter(function($participant){

            return $participant->purchases->first()->status !== "cancelled";

        })->groupBy("company_id");

        /*get representatives*/

        $this->info("Total reps found: " . $reps->count() );


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

            $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : $defaultlang;

            $name = !empty($companyProfile["name"]) ? $companyProfile["name"] : $ex->slug;

            $event_manager = (new EmailAddress($companyProfile["event_manager"]))->find();

            $cReps = array_get($reps, $ex->company_id, collect([]))->mapInto(Personalizer::class);

        
            if($whatWeDo === "empty"){

                if(!$cReps->count()){
                    $this->error("No reps " . $name . " lang: " . $lang);
                }

                continue;
            }

            $this->info("Processing " . $name . " lang: " . $lang);

            $this->line("Reps: " . $cReps->count());

            if($cReps->count() > $min){
                 $this->line("Skipped! Has more reps than " . $min);
                 continue;
            }

            if($lang !== $viewlang)
            {
                $this->line("Skipped! Lang mismatch. ");
                continue;
            }

        
            if($whatWeDo == "send")
            {
                $this->info("Notified");

                dispatch(new Job(
                        $ex, 
                        $cReps, 
                        $eventId,
                        array(
                            "viewlang" => $viewlang, 
                            "event_manager" => $event_manager,
                            "subject" => $subject,
                            "view" => $email
                        )
                ));
            }

            $done++;

        }   

        $this->info("Counted " . $done . " companies with reps <= " . $min);


    }
}
