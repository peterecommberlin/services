<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Exhibitors\Console;

class CompanyRankingPosition extends Command {
 
    protected $signature = 'exhibitors:ranking

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}';
    
    protected $description = 'Send email message to Exhibitors';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service)
    {
        $service->setParams($this->options());

        $whatWeDo  = $this->anticipate('Send, stats?', ['send', 'stats']);


        $errors = [];

        $viewlang       = $this->option("lang");
        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if($whatWeDo !== "stats"){
            if(empty($viewlang)) {
                $errors[] = "--lang= must be set!";
            }

            if(empty($subject)) {
                $errors[] = "--subject= must be set!";
            }
                    
            if(empty($email)) {
                $errors[] = "--email= must be set!";
            }

            $email = $email . "-" . $viewlang;

            if(! view()->exists("emails.company." . $email)) {
                $errors[] = "--email= error. View cannot be found!";
            }

        }
       
        if(!empty($errors)){
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

        /*
            RANKING SPECIFIC
        **/
        $apiCall = $service->getApi("/partner-performance");
        $ranking = collect(array_get($apiCall, "data", []))->mapWithKeys(function($item){

             return [$item['company_id'] => $item['stats']];
        });
        $prizes = array_get($apiCall, "meta.prizes");
        /*
            RANKING SPECIFIC
        **/

        $done = 0;

        $arr = $whatWeDo === "send" ? $filtered : $exhibitors;

        foreach($arr as $ex)
        {

            $stats = array_get($ranking, $ex->company_id, []);

            //do we have company assigned?

            if( !$ex->company_id ){
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            if( empty($stats) ){
                $this->error("No ranking data for" . $ex->email);
                continue;
            }

            if( !$ex->hasAccountManager() ){
                $this->error( "No account assigned for " . $ex->email );
               // continue;
            }

            dd($stats);

            $lang           = $ex->getLang();
            $name           = $ex->getName();
            $event_manager  = $ex->getEventManager();
            //$cReps          = $ex->getReps();

            $this->line("Processing " . $name . "/" . $ex->email);

            if($whatWeDo === "send"){

                if($lang !== $viewlang)
                {
                    $this->info("Skipped! Lang mismatch. ");
                    continue;
                }
            
                $this->line("Notifying " . $ex->email);

                dispatch(new Job(
                    $ex->getModel(), 
                    $eventId, 
                    compact("email", "subject", "event_manager", "viewlang", "lang", "domain", "stats") 
                ));

            }
            
            $done++;

        }   

        $this->info("Delivered " . $done . " messages");


    }
}
