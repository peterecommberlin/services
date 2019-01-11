<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;



class GeneralExhibitorMessage extends Command
{

 
    protected $signature = 'exhibitors:current-event 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=} 
        {--throttle=1}';
    
    protected $description = 'Send general email message to Exhibitors';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ParticipantSendable $sendable, CompanyData $cd)
    {

        $domain = $this->option("domain");
        $email =  $this->option("email");
        $subject =  $this->option("subject");

        if(empty($domain)) {
            return $this->error("--domain= must be set!");
        }

        if(empty($subject)) {
            return $this->error("--subject= must be set!");
        }
    
        
        if(empty($email)) {
            return $this->error("--email= must be set!");
        }

        if(! view()->exists("emails.company." . $email)) {
            return $this->error("--email= error. View cannot be found!");
        }


        /**
            LET'S FUCKING START!
        **/


        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $exhibitors = $repo->get($eventId, "exhibitor")->unique("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $sendable->checkUniqueness(false);

        $sendable->setMuteTime(20); //minutes!!!!

        $exhibitors = $sendable->filter($exhibitors, $eventId);

        $this->info("Exhibitors that can be notified: " . $exhibitors->count() );

        $done = 0;

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

            $event_manager = isset($companyProfile["event_manager"]) ? $companyProfile["event_manager"] : "";


            if($event_manager && !filter_var($event_manager, FILTER_VALIDATE_EMAIL)){

                $this->error($ex->email . " - bad event manager email");
                $event_manager = "";
            }


            if($lang !== $this->option("lang"))
            {
                $this->error("Skipped! Lang mismatch. ");
                continue;
            }

            $this->info("Processing " . $ex->company->slug);

            $this->info("Notifying " . $ex->email);

            dispatch(new Job(
                $ex, 
                $eventId, 
                compact("email", "subject", "event_manager", "lang", "domain") 
            ));
            
            $done++;

        }   

        $this->info("Delivered " . $done . " messages");


    }
}
