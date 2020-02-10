<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\Exhibitors\Console;


use Eventjuicer\Repositories\CompanyRepository;
use Eventjuicer\Repositories\Criteria\WhereIn;
use Eventjuicer\Repositories\Criteria\BelongsToGroup;
use Eventjuicer\Models\CompanyData as CDModel;
use Illuminate\Support\Str;
use Eventjuicer\Services\CompanyData as LegacyCompanyData;
use Eventjuicer\Services\Hashids;

class ExhibitorGeneratePasswords extends Command
{

    protected $signature = 'exhibitors:generate-passwords 
        {--domain=} 
        {--password=""}
    ';
    
    protected $description = 'Generate passwords';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(CompanyRepository $companies, LegacyCompanyData $cd)
    {

        $domain     = $this->option("domain");
      
        $password    = $this->option("password");

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

        $groupId =  $route->getGroupId();
        $eventId =  $route->getEventId();

        $this->info("Group id: " . $groupId);

        $companies->pushCriteria( new BelongsToGroup($groupId));

        $selectedCompanies = $companies->all();

        $done = 0;

        foreach($selectedCompanies as $c)
        {
            //regenerate data if needed

            $cd->make($c);

            $password = CDModel::where("company_id", $c->id)->where("name", "like", "password")->get()->first();
            $password->value = !empty($password)? $password: (new Hashids())->encodeArr( [$eventId, $c->id] );
            $password->save();

            $this->line($c->id . " - " . $password->value );           
            $done++;

        }   

        $this->info("Generated " . $done . " passwords");


    }
}
