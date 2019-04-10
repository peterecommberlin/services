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
use Eventjuicer\Models\Participant;


class FixReps extends Command
{

 
    protected $signature = 'exhibitors:fixreps

        {--domain=} 
       
       ';
    
    protected $description = 'Check and fix representatives';
 
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

        $representatives = $repo->get($eventId, "representative");

        $exhibitors = resolve(GetByRole::class)->get($eventId, "exhibitor")->keyBy("company_id");


        $this->info("Number of representatives: " . $representatives->count() );

        $done = 0;

        foreach($representatives as $rep)
        {

            $errors = array();

            //do we have company assigned?

            if(!$rep->company_id)
            {
                $errors[] = "No company assigned for " . $rep->email . " - skipped.";
            }

            $companyProfile = $cd->toArray($rep->company);
            $name = !empty($companyProfile["name"]) ? $companyProfile["name"] : ">>> BLANK <<<";
         

            if( !isset( $exhibitors[ $rep->company_id ]) ){
                $errors[] = "Bad company assigned";
            }

            $currentEventExhibitor = $exhibitors[ $rep->company_id ];

            if(is_null($rep->parent))
            {
                $errors[] = "No PARENT assigned for " . $rep->email . " company: " . $name;
            }

            if($rep->parent->event_id != $eventId){
                $errors[] = "Bad parent!" . $rep->email . " company: " . $name;
            }

            if(count($errors)){

                $this->error("Error(s) found in " . $rep->email);
                $this->line("Rep Id: " . $rep->id);
                $this->line("Company name: " . $name);

                foreach($errors as $error){
                    $this->line($error);
                }

                $this->line("Target Parent Id: " . $currentEventExhibitor->id);
                $this->line("Parent email: " . $currentEventExhibitor->email);


                $rep->parent_id = $currentEventExhibitor->id;
                $rep->save();

                $done++;
            }

            // $this->line($currentEventExhibitor->email . "id: " . $currentEventExhibitor->id);


          

        }   

        $this->info("Errors " . $done . "");


    }
}
