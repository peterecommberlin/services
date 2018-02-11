<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\BelongsToGroup;
use Eventjuicer\ValueObjects\EmailAddress;
use App\Jobs\Revivers\ParticipantInvite;
use Eventjuicer\Services\Revivers\ParticipantSendable;

class EmailDisbelievers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:disbelievers {host} {ticketId?}';

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
    public function handle(ParticipantRepository $repo, ParticipantSendable $sendable)
    {
        $route = new Resolver($this->argument("host"));

        $this->info("Event id: " . $route->getEventId() );

        //get all from this event and build a list....

        $repo->pushCriteria(new BelongsToGroup(  $route->getGroupId() ));

        $all = $repo->all();

        $excludes = $all->where("event_id", $route->getEventId())->pluck("email")->all();

        $filtered =  $sendable->filter($difference, $route->getEventId(), $excludes);

        $this->info( count($filtered) . " dispatched" );

        foreach($filtered as $participant)
        {

            if( !(new EmailAddress($participant->email))->isValid() )
            {
                $this->error("Invalid email: " . $participant->email );
                continue;
            }

            dispatch( new ParticipantInvite( $email, $route->getEventId() ) );
        }
       
        $this->info( count($filtered) . " dispatched" );
    }





}
