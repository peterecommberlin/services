<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Jobs\PingWhenEmptyProfileJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;

/*

changes
===========================
use event_manager as CC contact
handle language differently

*/

class PingWhenEmptyProfile extends Command
{

 
    protected $signature = 'companies:emptyprofile {host}';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, CompanyData $cd, ParticipantSendable $sendable)
    {

        $host = $this->argument("host");

        $route = new Resolver( $host );

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
