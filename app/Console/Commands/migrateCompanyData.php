<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;
use Eventjuicer\Repositories\Criteria\ColumnGreaterThan;
use Eventjuicer\Services\CompanyData;

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
    public function handle(ParticipantRepository $p, CompanyData $cd)
    {
        $route = new Resolver($this->argument("host"));

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        //fetch all participants with company_id > 0

        $p->pushCriteria(new BelongsToEvent($eventId));
        $p->pushCriteria(new ColumnGreaterThan("company_id", 0));
        $p->with(["fields"]);

        $force  = $this->anticipate('Force update?', ['new', 'all']);

        $participants = $p->all();

        $this->info($participants->count() . " participants found.");

        foreach($participants as $participant)
        {
           $fieldsUpdated = $cd->migrate($participant, ($force === "all") );

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
