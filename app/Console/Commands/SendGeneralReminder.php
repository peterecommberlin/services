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
    protected $signature = 'visitors:current-event

        {--domain=}
        {--email=} 
        {--subject=}

    ';

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

        $errors = [];

        $domain = $this->option("domain");
        $email =  $this->option("email");
        $subject =  $this->option("subject");

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($subject)) {
            $errors[] = "--subject= must be set!";
        }
    
        
        if(empty($email)) {
            $errors[] = "--email= must be set!";
        }

        if(! view()->exists("emails.visitor." . $email)) {
            return $this->error("--email= error. View cannot be found!");
        }

        if(!empty($errors)){
                $this->error("Errors found:");
            foreach($errors AS $error){
                 $this->line($error);
            }
            return;
        }


        $route = new Resolver($domain);

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $participants = $ticketRepo->getParticipantsWithTicketRole("visitor", "event", $eventId);

        $this->info("Total visitors: " . $participants->count());

        $sendable->checkUniqueness(true);
        
        $filtered = $sendable->filter($participants, $eventId);

        $this->info("Visitors that can be notified: " . $filtered->count() );


        $whatWeDo  = $this->anticipate('Send, stats, test?', ['test', 'send', 'stats']);

        if($whatWeDo === "stats"){
            return;
        }

        $counter = 1;

        foreach($filtered as $participant)
        {

            if(!filter_var($participant->email, FILTER_VALIDATE_EMAIL)){
                $this->error("Wrong email address: " . $participant->email);
                continue;
            }

            if($counter % 100 === 0){

                $this->info("Dispatched " . $counter);
            }

            dispatch(new Job(
                $participant, 
                $eventId,
                compact("subject", "email")
            ));

            if($whatWeDo === "test"){
                break;
            }

            $counter++;
        }

        $this->info("Done.");

    }
}
