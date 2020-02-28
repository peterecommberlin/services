<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\Company;
use Eventjuicer\ValueObjects\EmailAddress;
use Eventjuicer\Services\Exhibitors\Console;


/*  "data": [
        {
            "id": 98740,
            "company_id": 1573,
            "name": "A4G DSP",
            "logotype": "https://res.cloudinary.com/eventjuicer/image/upload/w_600,h_300,c_fit/v1570194922/c_1573_logotype.png",
            "stats": {
                "id": 1573,
                "sessions": 2560,
                "conversions": 0,
                "position": 1,
                "prizes": [
                    "badges",
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
        }
*/

class AwardMessage extends Command {

 
    protected $signature = 'exhibitors:award 
        {--award=}
        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}
        {--previous}
        {--reverse}
        {--defaultlang=}';
    
    protected $description = 'Send email message to awarded Exhibitors';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service)
    {

        $whatWeDo  = $this->anticipate('Send, stats, test?', ['test', 'send', 'stats']);

        $award = $this->option("award");
        $domain = $this->option("domain");
        $email =  $this->option("email");
        $subject =  $this->option("subject");
        $viewlang = $this->option("lang");
        $defaultlang = $this->option("defaultlang");

        $previous =  $this->option("previous");
        $reverse =  $this->option("reverse");

        $errors = array();

        if(empty($award)) {
            $errors[] = "--award= must be set";
        }

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if($whatWeDo === "send"){

            if(empty($subject)) {
                $errors[] = "--subject= must be set!";
            }
            
            if(empty($email)) {
                $errors[] = "--email= must be set!";
            }

            if(empty($viewlang)) {
                $errors[] = "--lang= must be set!";
            }

            if(empty($defaultlang)) {
                $errors[] = "--defaultlang= must be set!";
            }
        
            $email = $email . "-" . $viewlang;

            if($whatWeDo == "send" && ! view()->exists("emails.company." . $email)) {
                $errors[] = "--email= error. View " . $email . " cannot be found";
            }

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

        $service->run($domain, !empty($previous));

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        $exhibitors = $service->getDataset(true);

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $filtered = $service->getSendable();

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $apiCall = $service->getApi("/partner-performance?event_id=" . $eventId);

        // $ranking = array_get($apiCall, "data");

        $ranking = collect(array_get($apiCall, "data", []))->mapWithKeys(function($item){

             return [$item['company_id'] => $item['stats']];
        });

        $prizes = array_get($apiCall, "meta.prizes");

        $prizes = collect($prizes)->keyBy("name")->all();

        if(!isset($prizes[$award])){
            return $this->error("award not defined!");
        }

        $awardRules = $prizes[$award];

        $done = 0;

        $arr = $whatWeDo === "send" ? $filtered : $exhibitors;

        foreach($arr as $ex)
        {

            $assigned = 0;

            if(! $ex->hasCompany() )
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            $stats          = array_get($ranking, $ex->company_id, []);
            $prizes     = array_get($stats, "prizes", []);

            dd($prizes);

            /*IF $award in PRIZES than assigned = 1 {
    
                $this->info("Assigned for " . $ex->company->slug);

                $assigned = 1;

            }*/

            if($reverse){
                $assigned = !$assigned;
            }

            if(!$assigned){
                $this->line("Skipping " . $ex->email);
                continue;
            }

            if($whatWeDo === "send"){

                // $cdh->setData($ex->company->data);
                // $event_manager = $cdh->manager("event");
                // $lang = $cdh->lang("en");


                $lang           = $ex->getLang();
                $name           = $ex->getName();
                $event_manager  = $ex->getEventManager();
                //$cReps          = $ex->getReps();
                $translations   = array_get($allTranslations, $lang);

                if($lang !== $viewlang)
                {
                    $this->error("Skipped! Lang mismatch. ");
                    continue;
                }

                $this->line("Notifying " . $ex->email);

                dispatch(new Job(
                    $ex->getModel(), 
                    $eventId, 
                    compact(
                        "email", 
                        "subject", 
                        "event_manager", 
                        "viewlang", 
                        "lang", 
                        "domain"
                    ) 
                ));
            }
            
            $done++;

        }   

        $this->info("Assigned for " . $done . " exhibitors");

    }
}
