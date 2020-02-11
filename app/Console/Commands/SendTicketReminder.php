<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\EloquentTicketRepository;
use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\WhereIn;
use Eventjuicer\Repositories\Criteria\RelEmpty;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use App\Jobs\SendTicketDownloadReminder;

class SendTicketReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitors:ticket-reminder  {--domain=} ';

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
        ParticipantRepository $participantsRepo,
        ParticipantSendable $sendable
    )
    {

        $domain = $this->option("domain");

        $errors = [];

        if(empty( $domain )) {
            $errors[] = "--domain= must be provided!";
        }

        if(!empty($errors))
        {
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }


        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $participantsByTicketRole = $ticketRepo->getParticipantsWithTicketRole("visitor", "event", $eventId);

        $participant_ids = $participantsByTicketRole->pluck("id")->all();

        $this->info("Total visitors: " . count($participant_ids) );

        $participantsRepo->pushCriteria(new WhereIn("id", $participant_ids));
        $participantsRepo->pushCriteria(new RelEmpty("ticketdownloads"));

        //it is pointless to preload relations as they will not be serialized by JOB dispatcher!
        $participants = $participantsRepo->all();

        $this->info("Visitors without a RSVP: " . $participants->count() );

        //ANTI SPAM!!!

        $sendable->checkUniqueness(false);
        
        $participants = $sendable->filter($participants, $eventId);

        $this->info("Visitors that can be notified: " . $participants->count() );

        $counter = 1;

        $whatWeDo  = $this->anticipate('test, send, status?', ['test', 'send', 'status']);

        if($whatWeDo === "status"){
            return;
        }


        foreach($participants as $participant)
        {

            if(!filter_var($participant->email, FILTER_VALIDATE_EMAIL)){
                $this->error($participant->email);
                continue;
            }

           dispatch(new SendTicketDownloadReminder($participant, $eventId));

           if($whatWeDo === "test" || env("MAIL_TEST", false)){
                break;
           }

            if($counter % 100 === 0){

                $this->info("Dispatched " . $counter);
            }

            $counter++;
        }

        $this->info("Done. Dispatched jobs: " . $counter);

    }
}
