<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;
use Eventjuicer\Repositories\Criteria\ColumnGreaterThan;
use Eventjuicer\Services\Exhibitors\Migrator;
use Eventjuicer\Services\GetByRole;


class migrateCompanyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exhibitors:migrate {host}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate data from participant profile to company data model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(GetByRole $gbr, ParticipantRepository $p, Migrator $cd)
    {
        $route = new Resolver($this->argument("host"));

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        //fetch all participants with company_id > 0
        //this is wrong as company may be assigned to non-exhibitor fields....

        $participants = $gbr->get(
                $eventId, 
                "exhibitor", 
                ["company.data", "fields"]
        );

        // $p->pushCriteria(new BelongsToEvent($eventId));
        // $p->pushCriteria(new ColumnGreaterThan("company_id", 0));
        // $p->with(["fields"]);
        // $participants = $p->all();

        $force  = $this->anticipate('Add or replace?', ['add', 'replace']);

        $this->info($participants->count() . " exhibitors found.");

        foreach($participants as $participant)
        {
           $fieldsUpdated = $cd->migrate($participant, ($force === "replace") );

           $this->line("Processing: " . $participant->email);

           if( is_array($fieldsUpdated) && count($fieldsUpdated) )
            {
                $this->info(implode(",", $fieldsUpdated) . " updated.");
            }
            else
            {
                $this->error("skipped...");
            }
        }

    }
}
