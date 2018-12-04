<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Services\PartnerPerformance;



class AwardMessage extends Command
{

 
    protected $signature = 'exhibitors:award 
        {--award=}
        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=} 
        {--throttle=1}';
    
    protected $description = 'Send email message to awarded Exhibitors';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(PartnerPerformance $performance, GetByRole $repo, ParticipantSendable $sendable, CompanyData $cd)
    {


        $award = $this->option("award");

        $prizes = collect($performance->getPrizes())->keyBy("name")->all();

        if(!isset($prizes[$award])){
            return $this->error("award not defined!");
        }

        $awardRules = $prizes[$award];


        $domain = $this->option("domain");
        $email =  $this->option("email");
        $subject =  $this->option("subject");

        if(empty($award)) {
            return $this->error("--award= must be set");
        }

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

        $json = json_decode(file_get_contents("https://api.eventjuicer.com/v1/restricted/ranking?x-token=14eaeff0fd38d721de655330237a1fb7bcb41bb1", false, stream_context_create($arrContextOptions)), true);

        if(empty($json) || empty($json["data"])) {
            return $this->error("Cannot import GA data");
        }

        $ranking = $json["data"];

        $assigned = 0;

        foreach($exhibitors as $ex)
        {
            //do we have company assigned?

            if(!$ex->company_id)
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
                        $this->error("Not assigned - level" . $ex->email);
                        continue;
                    }

                    if($realPosition < $awardRules["min"]){
                        $this->error("Not assigned - level" . $ex->email);
                        continue;
                    }

                    if($realPosition > $awardRules["max"]){
                        $this->error("Not assigned - level" . $ex->email);
                        continue;
                    }

                    $this->info("Assigned for " . $ex->email);

                    $assigned++;
                   
                }

            }


            $companyProfile = $cd->toArray($ex->company);

            $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : "pl";

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

            // dispatch(new Job(
            //     $ex, 
            //     $eventId, 
            //     compact("email", "subject", "event_manager", "lang") 
            // ));
            
            $done++;

        }   

        $this->info("Assigned " . $assigned . " awards");
        $this->info("Delivered " . $done . " messages");

    }
}
