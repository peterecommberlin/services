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

class ExhibitorGeneratePasswords extends Command
{

    protected $signature = 'exhibitors:generate-passwords 
        {--domain=} 
        {--company_ids=""} 
        {--password=""}
    ';
    
    protected $description = 'Generate passwords';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(CompanyRepository $companies)
    {

        $domain     = $this->option("domain");
        $company_ids = $this->option("company_ids");
        $password    = $this->option("password");

        $errors = [];

        // if(!empty($company_ids)) {
        //     $errors[] = "--company_ids= must be set!";
        // }

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        // if(empty($password)) {
        //     $password[] = "--subject= must be set!";
        // }

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

        $this->info("Group id: " . $groupId);

        $companies->pushCriteria( new BelongsToGroup($groupId));

        if($company_ids){
            $companies->pushCriteria( new WhereIn("id", explode(",", $company_ids)));
        }
        $selectedCompanies = $companies->all();

        $done = 0;

        foreach($selectedCompanies as $c)
        {
            //regenerate data if needed

            $cd->make($c);

            $newPass = Str::random(6); //$c->id . base_convert(microtime(false), 10, 36);

            $password = CDModel::where("company_id", $c->id)->where("name", "like", "password")->get()->first();
            $password->value = $newPass;
            $password->save();

            $this->line("Generated " .$newPass );           
            $done++;

        }   

        $this->info("Generated " . $done . " passwords");


    }
}
