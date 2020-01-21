<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Eventjuicer\Services\Exhibitors\Console;

class SyncAccountToCompany extends Command
{
 
    protected $signature = 'exhibitors:accounts

        {--domain=} 
       
       ';
    
    protected $description = 'Map Company Name to Cname2';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service)
    {
       
        $mappings = array(

            "js" => 12,
            "bd" => 16,
            "am" => 13,
        );



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

        $this->info("Event id: " . $service->getEventId() );

        $exhibitors = $service->getDataset();

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );


        $done = 0;


        foreach($exhibitors as $ex)
        {
            //do we have company assigned?

            if(!$ex->company_id)
            {
               $this->error($ex->email . " - no company");
               continue;
            }

            $account = $ex->getAccount();

            if(!$account){
                $this->error($ex->getName() . " - no account");
                continue;
            }

            if(isset($mappings[$account])){

                $ex->company->admin_id = (int) $mappings[$account];
                $ex->company->save();
                $done++;
            }
            else{
                 $this->error($ex->getName() . " - bad account mapping / " . $account);
            }

          

        }   

        $this->info("Assigned: " . $done . "");


    }
}
