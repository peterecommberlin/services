<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\CompanyData;
use App\Jobs\PingWhenEmptyProfileJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;



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

        $route = new Resolver( $this->argument("host") );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $exhibitors = $repo->get($eventId, "exhibitor", ["company.data"])->unique("company_id");

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $sendable->checkUniqueness(false);

        $filtered = $sendable->filter($exhibitors, $eventId);

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $done = 0;

        foreach($exhibitors as $ex)
        {

            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email);
                continue;
            }

            //check for companydata fields freshness :)
            //check for required fields

            $status = $cd->status($ex->company);

            if(!count($status))
            {
                continue;
            }

            $this->info("Processing " . $ex->company->slug);
            $this->line("Fields with errors: " . implode(", ", array_keys($status)));
            $this->info("Notifying " . $ex->email);

            dispatch(new Job($ex, $eventId));

            $done++;

        }   

        $this->info("Dispatched " . $done . " jobs");


    }
}
