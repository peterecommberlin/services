<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Jobs\PingWhenEmptyProfileJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\ValueObjects\EmailAddress;

/*

//https://github.com/eventjuicer/admin/issues/3

changes
===========================
use event_manager as CC contact
handle language differently

*/

class PingWhenEmptyProfile extends Command
{

 
    protected $signature = 'companies:emptyprofile 
      {--domain=}
      {--maxold=1}
      {--defaultlang=}

    ';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, CompanyData $cd, ParticipantSendable $sendable)
    {


        $domain     = $this->option("domain");
        $maxold     = $this->option("maxold");
        $defaultlang     = $this->option("defaultlang");

        $errors = array();

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($maxold)) {
            $errors[] = "--maxold= must be set!";
        }

        if(empty($defaultlang)) {
            $errors[] = "--defaultlang= must be set!";
        }

        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }



        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $exhibitors = $repo->get($eventId, "exhibitor", ["company.data"])->unique("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $sendable->checkUniqueness(true);

        $sendable->setMuteTime(20); //minutes!!!!

        $filtered = $sendable->filter($exhibitors, $eventId);

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $done = 0;


        $whatWeDo  = $this->anticipate('Send or stats?', ['send', 'stats']);


        foreach($exhibitors as $ex)
        {
            
        
            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

            $companyProfile = $cd->toArray($ex->company);

            $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : $defaultlang;

            $event_manager = !empty($companyProfile["event_manager"]) ? (new EmailAddress($companyProfile["event_manager"]))->find() : "";

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

                dispatch(new Job($ex, $eventId, $lang, $event_manager, $domain));
            }

            $done++;

        }   

        $this->info("Counted " . $done . " companies with errors...");


    }
}
