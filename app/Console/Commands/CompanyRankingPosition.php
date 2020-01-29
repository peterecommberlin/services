<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Exhibitors\Console;
use Eventjuicer\Services\Exhibitors\Creatives;

class CompanyRankingPosition extends Command {
 
    protected $signature = 'exhibitors:ranking

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}
        {--threshold=0}
    ';
    
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

        $threshold  = $this->option("threshold");
        $viewlang   = $this->option("lang");
        $domain     = $this->option("domain");
        $view      = $this->option("email");
        $subject    = $this->option("subject");

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(!is_numeric($threshold)){
            $errors[] = "--threshold= must be an integer!";
        }

        if($whatWeDo === "send"){

            if(empty($viewlang)) {
                $errors[] = "--lang= must be set!";
            }

            if(empty($subject)) {
                $errors[] = "--subject= must be set!";
            }
                    
            if(empty($view)) {
                $errors[] = "--email= must be set!";
            }

            $email = $view . "-" . $viewlang;

            if($view && ! view()->exists("emails.company." . $email)) {
                $errors[] = "--email= View cannot be found! Bad language chosen?";
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

        $allTranslations = $service->getTranslations();

        /*
            RANKING SPECIFIC
        **/

        $done = 0;

        $arr = $whatWeDo === "send" ? $filtered : $exhibitors;

        foreach($arr as $ex)
        {

            //do we have company assigned?

            if( !$ex->company_id ){
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            $stats          = array_get($ranking, $ex->company_id, []);
            $sessions       = (int) array_get($stats, "sessions", 0);
            $position       = (int) array_get($stats, "position", 0);

            /*
                stats: {
                    id: 1650,
                    sessions: 311,
                    conversions: 0,
                    position: 3,
                    prizes: [
                        "presentation",
                        "video_interview",
                        "earlybird",
                        "meetups",
                        "brand_highlight",
                        "leaflets",
                        "rollups",
                        "blog"
                    ]
                }
            */

            $lang           = $ex->getLang();
            $name           = $ex->getName();
            $event_manager  = $ex->getEventManager();
            //$cReps          = $ex->getReps();

            $translations   = array_get($allTranslations, $lang);
            $creatives      = $ex->getCompany() ? (new Creatives($ex))->get() : [];
            
            $logotype       = $ex->logotype();


            $this->line("Processing " . $name . "/" . $ex->email);

            if( !$ex->hasAccountManager() ){
                $this->error( "No account assigned for " . $ex->email );
            }
 
            if( $sessions > $threshold ){
                $this->error("To many points: " . $sessions . " Skipping....");
                continue;
            }

             if( strpos($logotype, "cloudinary") === false ){
                $this->error("No valid logotype!");
                continue;
            }


            $this->line("Position: " . $position . ", sessions: " . $sessions);

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
                    compact("email", 
                            "subject", 
                            "event_manager", 
                            "viewlang", 
                            "lang", 
                            "domain", 
                            "stats", 
                            "prizes",
                            "translations",
                            "creatives"
                    ) 
                ));

            }

            $this->line("--------");
            
            $done++;

        }   

        $this->info("Processed " . $done . " exhibitors...");


    }
}
