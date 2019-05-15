<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;

use Eventjuicer\ValueObjects\EmailAddress;

class CompanyRankingReset extends Command
{

 
    protected $signature = 'exhibitors:ranking-reset {--domain=}';
    
    protected $description = 'Send email message to Exhibitors';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ApiUserLimits $limits, CompanyRepository $companies)
    {


       
        $domain     = $this->option("domain");
      
        if(empty($domain)) {
            return $this->error("--domain= must be set!");
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


            $event_manager = (new EmailAddress($companyProfile["event_manager"]))->find();


            if($lang !== $viewlang)
            {
                $this->info("Skipped! Lang mismatch. ");
                continue;
            }

            $this->line("Processing " . $ex->company->slug);

            $this->line("Notifying " . $ex->email);

            dispatch(new Job(
                $ex, 
                $eventId, 
                compact("email", "subject", "event_manager", "viewlang", "lang", "domain") 
            ));
            
            $done++;

        }   

        $this->info("Delivered " . $done . " messages");


    }
}
