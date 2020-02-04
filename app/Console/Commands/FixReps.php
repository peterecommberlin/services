<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Exhibitors\Console;
use Eventjuicer\Services\SaveOrder;

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
 
    public function handle(Console $service, SaveOrder $saveorder)
    {
        
        $service->setParams($this->options());

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

        $service->run($domain);

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        $representatives = $service->getAllReps();

        $exhibitors = $service->getDataset(true, false)->keyBy("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $filtered = $service->getSendable();

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $allTranslations = $service->getTranslations();

        $done = 0;




        foreach($representatives as $rep)
        {

            $errors = array();

            //do we have company assigned?

            if(!$rep->company_id)
            {
                $errors[] = "No company assigned for " . $rep->email . " - skipped.";
            }

            $name = $rep->getName();
         
            //cname2 of Parent!

            if(empty($name) || strlen($name) < 2){

                $errors[] = "Parent company NAME absent! " . $rep->email . " " . $rep->id;
            }
         
            if( !isset( $exhibitors[ $rep->company_id ]) ){
                $errors[] = "Cannot find company among exhibitors...";
                continue;
            }

            $currentEventExhibitor = $exhibitors[ $rep->company_id ];

            if(is_null($rep->parent))
            {
                $errors[] = "No PARENT assigned for " . $rep->email . " company: " . $name;
            }

            if($rep->parent->event_id != $eventId){
                $errors[] = "Bad parent!" . $rep->email . " company: " . $name;
            }

            //cname2 of REP

            $cname2 = $this->getCname2();

            if(strlen($cname2) < 2){
                 $errors[] = "Rep should have cname2 set...";
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
                
                if(strlen($name) > 1 && $cname2 != $name){

                    $this->line("Assigning cname2: " . $name);

                    $saveorder->setParticipant( $rep->getModel() );
                    $saveorder->setFields(["cname2" => $name]);
                    $saveorder->updateFields();
                }

                if($rep->parent_id != $currentEventExhibitor->id){
                    $rep->parent_id = $currentEventExhibitor->id;
                    $rep->save();   
                }

                $done++;
            }

            // $this->line($currentEventExhibitor->email . "id: " . $currentEventExhibitor->id);


          

        }   

        $this->info("Errors " . $done . "");


    }
}
