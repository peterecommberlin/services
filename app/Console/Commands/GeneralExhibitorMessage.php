<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Exhibitors\Console;


class GeneralExhibitorMessage extends Command {

 
    protected $signature = 'exhibitors:current-event 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}
        {--defaultlang=} 
        {--throttle=1}
        {--exclude_reg_ids=""}';
    
    protected $description = '--exclude_reg_ids="100,102,103';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service)
    {

        $service->setParams($this->options());

        $viewlang   = $this->option("lang");
        $defaultlang = $this->option("defaultlang");
        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");
        $exclude_reg_ids =  array_filter(explode(",", $this->option("exclude_reg_ids")), function($value){ return intval($value) > 0; }); 

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

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $allTranslations = $service->getTranslations();

        $done = 0;

        $whatWeDo  = $this->anticipate('Send, test?', ['test', 'send']);

        if(!empty($exclude_reg_ids)) {
            
            $this->error( count($exclude_reg_ids) . " regs excluded" );
        
        }

        foreach($filtered as $ex)
        {

            if(!empty( $exclude_reg_ids ) && in_array($ex->getModel()->id, $exclude_reg_ids) ){
            
                $this->error("registration excluded" . $ex->email );
                continue;                
            }

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
            $event_manager  = $ex->getEventManager();
            //$cReps          = $ex->getReps();
            $translations   = array_get($allTranslations, $lang);

            if($lang !== $viewlang)
            {
                $this->info("Skipped! Lang mismatch. ");
                continue;
            }

            $this->line("Processing " . $name);

            $this->line("Notifying " . $ex->email);


            dispatch(new Job(
                $ex->getModel(), 
                $eventId, 
                compact("email", "subject", "event_manager", "viewlang", "lang", "domain", "translations") 
            ));

            $done++;

            if($done && $whatWeDo === "test"){
                break;
            }
            
        }   

        $this->info("Delivered " . $done . " messages");


    }
}
