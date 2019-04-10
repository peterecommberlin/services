<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;

use Eventjuicer\ValueObjects\EmailAddress;
use Eventjuicer\Services\SaveOrder;

class MapCompanyNameToCname2 extends Command
{

 
    protected $signature = 'exhibitors:remap

        {--domain=} 
       
       ';
    
    protected $description = 'Map Company Name to Cname2';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, CompanyData $cd, SaveOrder $saveorder)
    {


       
        $domain     = $this->option("domain");
       
        $errors = [];

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
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

        $exhibitors = $repo->get($eventId, "exhibitor");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );


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

            $name = $companyProfile["name"];

            if(strlen($name)<2){
                $this->error("No company name for " . $ex->email . " - skipped.");
                continue;
            }

            $saveorder->setParticipant($ex);

            $saveorder->setFields(["cname2" => $name]);

            $saveorder->updateFields();

            $this->line("Mapped " . $name);

            $done++;

        }   

        $this->info("Mapped " . $done . "");


    }
}
