<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\SaveOrder;
use Eventjuicer\Services\Exhibitors\Console;


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
 
    public function handle(Console $service, SaveOrder $saveorder)
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

        $service->run($domain);

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        //switch off unique company_id
        $exhibitors = $service->getDataset(false);

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

            $name = $ex->getName();

            if(strlen($name)<2){
                $this->error("No company name for " . $ex->email . " - skipped.");
                continue;
            }

            $saveorder->setParticipant( $ex->getModel() );

            $saveorder->setFields(["cname2" => $name]);

            $saveorder->updateFields();

            $this->line("Mapped " . $name);

            $done++;

        }   

        $this->info("Mapped " . $done . "");


    }
}
