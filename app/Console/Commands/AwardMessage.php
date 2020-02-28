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

class AwardMessage extends Command
{

 
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

        $ranking = array_get($apiCall, "data");
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

            if(!  $company->id )
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            dd($ex);

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


                $companyProfile = $cd->toArray($ex->company);

                $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : $defaultlang;

                $event_manager = isset($companyProfile["event_manager"]) ? (new EmailAddress($companyProfile["event_manager"]))->find() : "";

                if($lang !== $viewlang)
                {
                    $this->error("Skipped! Lang mismatch. ");
                    continue;
                }

                $this->line("Notifying " . $ex->email);

                dispatch(new Job(
                    $ex, 
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
