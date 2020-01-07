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

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        $whatWeDo  = $this->anticipate('Send, stats, empty?', ['send', 'stats', 'empty']);

        if($whatWeDo === "send"){

            if(empty($viewlang)) {
                $errors[] = "--lang= must be set!";
            }

            if(empty($defaultlang)) {
                $errors[] = "--defaultlang= must be set!";
            }


            if(empty($subject)) {
                $errors[] = "--subject= must be set!";
            }

            if(empty($email)) {
                $errors[] = "--email= must be set!";
            }

            if($viewlang && ! view()->exists("emails.company." . $email . "-" . $viewlang)) {
            $errors[] = "--email= error. View cannot be found!";
            }
        }
 

        if(empty($min)) {
            $errors[] = "--min= must be set!";
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


 

        /*get representatives*/

        $repsRepo->pushCriteria( new BelongsToEvent($eventId));
        $repsRepo->pushCriteria( new ColumnGreaterThanZero("parent_id") );
        $repsRepo->with(["fields", "purchases"]);
        $reps = $repsRepo->all();


        $reps = $reps->filter(function($participant){

            return $participant->purchases->first()->status !== "cancelled";

        })->groupBy("company_id");

        /*get representatives*/

        $this->info("Total companies with reps found: " . $reps->count() );

        $iterate = ($whatWeDo === "send") ? $filtered : $exhibitors;

        $done = 0;
        
        foreach($iterate as $ex)
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


            $this->info("Processing " . $name . " lang: " . $lang);

            if($cReps->count() >= $min){
                 continue;
            }
        
            if($whatWeDo !== "send"){

                if(!$cReps->count()){
                    $this->error("No reps!");
                }else{
                    $this->line("Reps: " . $cReps->count());
                }

                continue;
            }
    

        
            if($whatWeDo == "send")
            {

                if($lang !== $viewlang)
                {
                    $this->line("Skipped! Lang mismatch. ");
                    continue;
                }

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
