<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\EloquentTicketRepository;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use App\Jobs\SendGeneralReminder as Job;



class SendGeneralReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:visitors {host}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle(
        EloquentTicketRepository $ticketRepo, 
        ParticipantSendable $sendable
    )
    {
        $route = new Resolver($this->argument("host"));

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $participants = $ticketRepo->getParticipantsWithTicketRole("visitor", "event", $eventId);

        $this->info("Total visitors: " . $participants->count());

        $sendable->checkUniqueness(false);
        
        $filtered = $sendable->filter($participants, $eventId);

        $this->info("Visitors that can be notified: " . $filtered->count() );

        foreach($filtered as $participant)
        {
          dispatch(new Job($participant, $eventId));
        }

        $this->info("Done.");

    }
}
