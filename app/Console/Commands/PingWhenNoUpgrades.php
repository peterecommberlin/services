<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Exhibitors\Console;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;


/*

changes
===========================
use event_manager as CC contact
handle language differently

*/

class PingWhenNoUpgrades extends Command
{

 
    protected $signature = 'companies:noupgrades {--domain=}';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service)
    {

        $domain    = $this->option("domain");

        $errors = array();

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        // if(empty($role)) {
        //     $errors[] = "--role= must be set!";
        // }
    
        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }

     

        /////



        $whatWeDo  = $this->anticipate('Send or stats?', ['send', 'stats']);


        foreach($exhibitors as $ex)
        {
            
        
            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

          

            $lang = isset($companyProfile["lang"]) ? $companyProfile["lang"] : "";
            $event_manager = isset($companyProfile["event_manager"]) ? $companyProfile["event_manager"] : "";

            //we actually should handle this by view name...

            // if( === "en")
            // {
            //     $this->error("Skipped! Lang mismatch. " . $ex->email);
            //     continue;
            // }


            //check for companydata fields freshness :)
            //check for required fields

            $status = $cd->status($ex->company);

            if(!count($status))
            {
                continue;
            }

            $this->line("----");
            $this->info("Processing " . $ex->company->slug . " lang: " . $lang);

            $this->line("Fields with errors: " . implode(", ", array_keys($status)));

            if($whatWeDo === "send")
            {
                $this->info("Notifying " . $ex->email);
                $this->line("----");

                dispatch(new Job($ex, $eventId, $lang, $event_manager, $host));
            }

            $done++;

        }   

        $this->info("Counted " . $done . " companies with errors...");


    }
}
