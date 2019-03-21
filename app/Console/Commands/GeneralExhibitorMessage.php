<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;

use Eventjuicer\ValueObjects\EmailAddress;

class GeneralExhibitorMessage extends Command
{

 
    protected $signature = 'exhibitors:current-event 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}
        {--defaultlang=} 
        {--throttle=1}';
    
    protected $description = 'Send general email message to Exhibitors';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ParticipantSendable $sendable, CompanyData $cd)
    {


        $viewlang   = $this->option("lang");
        $defaultlang = $this->option("defaultlang");
        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");

        $errors = [];

        if(empty($viewlang)) {
            $errors[] = "--lang= must be set!";
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

        if(empty($defaultlang)) {
            $errors[] = "--defaultlang= must be set!";
        }

        $email = $email . "-" . $viewlang;

        if(! view()->exists("emails.company." . $email)) {
            $errors[] = "--email= error. View cannot be found!";
        }

        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
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

            $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : $defaultlang;


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
