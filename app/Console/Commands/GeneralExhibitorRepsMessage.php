<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Exhibitors\Console;
use Eventjuicer\Services\Revivers\ParticipantSendable;

class GeneralExhibitorRepsMessage extends Command {

 
    protected $signature = 'reps:current-event 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}
        {--defaultlang=} 
        {--throttle=1}';
    
    protected $description = 'Send general email message to Representatives only...';
 
    public function __construct(){
        parent::__construct();
    }
 
    public function handle(Console $service, ParticipantSendable $sendable){

        $service->setParams($this->options());

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

        $service->run($domain);

        $eventId =  $service->getEventId();


        $this->info("Event id: " . $eventId );

        $exhibitors = $service->getDataset(true);

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $filtered = $service->getSendable();

        //REPS!
        $sendable->setEventId($eventId);

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $allTranslations = $service->getTranslations();

        $done = 0;

        foreach($filtered as $ex)
        {
            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }


            if( !$ex->hasAccountManager() ){
                $this->error( "No account assigned for " . $ex->getName() );
               // continue;
            }

            $lang           = $ex->getLang();
            $name           = $ex->getName();
            $cReps          = $ex->getReps("representative", false);
            $translations   = array_get($allTranslations, $lang);

            if($lang !== $viewlang)
            {
                $this->info("Skipped! Lang mismatch. ");
                continue;
            }

            $this->line("Processing " . $name . " reps." . $cReps->count());

            $filteredReps = $send

            foreach($cReps AS $rep){

                dispatch(new Job(
                    $rep, 
                    $eventId, 
                    compact("email", "subject", "viewlang", "lang", "domain", "translations") 
                    ));
            
                $done++;

                $this->line("Notifying " . $rep->email);
            }

        }   

        $this->info("Delivered " . $done . " messages");


    }
}
