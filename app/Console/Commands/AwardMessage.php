<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Services\PartnerPerformance;

use Eventjuicer\Services\Company;
use Eventjuicer\Services\CompanyDataHelpers;
use Eventjuicer\ValueObjects\EmailAddress;


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
 
    public function handle(PartnerPerformance $performance, GetByRole $repo, ParticipantSendable $sendable, CompanyData $cd, CompanyDataHelpers $cdh)
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

        if($whatWeDo == "send" && empty($subject)) {
            $errors[] = "--subject= must be set!";
        }
        
        if($whatWeDo == "send" && empty($email)) {
            $errors[] = "--email= must be set!";
        }

        if($whatWeDo == "send" && empty($viewlang)) {
            $errors[] = "--lang= must be set!";
        }

        if(empty($defaultlang)) {
            $errors[] = "--defaultlang= must be set!";
        }

        $viewPath = "emails.company." . $email . "-" . $viewlang;

        if($whatWeDo == "send" && ! view()->exists($viewPath)) {
            $errors[] = "--email= error. View " . $viewPath . " cannot be found";
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

        if(!empty($previous)){

            $eventId =  $route->previousEvent();
        }else{

            $eventId =  $route->getEventId();
        }


        $prizes = collect($performance->getPrizes( $route->getGroupId() ))->keyBy("name")->all();

        if(!isset($prizes[$award])){
            return $this->error("award not defined!");
        }

        $awardRules = $prizes[$award];



        //PARTNER PERFORMANCE

        $this->info("Event id: " . $eventId);

        $exhibitors = $repo->get($eventId, "exhibitor")->unique("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $sendable->checkUniqueness(false);

        $sendable->setMuteTime(20); //minutes!!!!

        $exhibitors = $sendable->filter($exhibitors, $eventId);

        $this->info("Exhibitors that can be notified: " . $exhibitors->count() );

        $done = 0;


        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  

        //TEH 14eaeff0fd38d721de655330237a1fb7bcb41bb1
        //EBE e4db333f554ae1751bfe4863a4dee9d5ad21fd9d

        $json = json_decode(file_get_contents("https://api.eventjuicer.com/v1/restricted/ranking?x-token=14eaeff0fd38d721de655330237a1fb7bcb41bb1&x-event-id=" . $eventId, false, stream_context_create($arrContextOptions)), true);

        if(empty($json) || empty($json["data"])) {
            return $this->error("Cannot import GA data");
        }

        $ranking = $json["data"];


        foreach($exhibitors as $ex)
        {

            $assigned = 0;

            //do we have company assigned?

            $company = (new Company())->make($ex);

            if(!  $company->id )
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            //do we have a winner????

            foreach($ranking as $position => $companyRankingData){

                //remember that position is ZERO-based!!!!

                $realPosition = $position + 1;

                if($companyRankingData["id"] == $ex->company_id){

                    if($companyRankingData["stats"]["sessions"] < $awardRules["level"]){
                        $this->error("Not assigned - points. " . $ex->email);
                        continue;
                    }

                    if($realPosition < $awardRules["min"]){
                        $this->error("Not assigned - min position. " . $ex->email);
                        continue;
                    }

                    if($realPosition > $awardRules["max"]){
                        $this->error("Not assigned - max position. " . $ex->email);
                        continue;
                    }

                    $this->info("Assigned for " . $ex->company->slug);

                    $assigned = 1;
                }

            }

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
