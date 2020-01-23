<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\ApiUser;
use Eventjuicer\Services\ApiUserLimits;
use Eventjuicer\Repositories\CompanyRepository;


class CompanyRankingReset extends Command
{

 
    protected $signature = 'exhibitors:ranking-reset {--domain=}';
    
    protected $description = 'set all tweaks to 0';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ApiUserLimits $limits, CompanyRepository $companies)
    {

        $errors = [];
       
        $domain     = $this->option("domain");
      
        if(empty($domain)) {
            $this->errors[] = "--domain= must be set!";
        }

        if(!empty($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return false;
        }

        /**
            LET'S FUCKING START!
        **/


        

        foreach($exhibitors as $ex)
        {
            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            $this->line("Processing " . $ex->company->slug);

            $this->line("Notifying " . $ex->email);

            
            
            $done++;

        }   

        $this->info("Delivered " . $done . " messages");


    }
}
