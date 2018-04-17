<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\ParticipantRepository;

use Eventjuicer\Repositories\Criteria\BelongsToGroup;
use Eventjuicer\Repositories\Criteria\SortByDesc;

use Eventjuicer\ValueObjects\EmailAddress;
use App\Jobs\Revivers\ParticipantInvite as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;

class EmailDisbelievers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:disbelievers 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--test=}

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
    public function handle(ParticipantRepository $repo, ParticipantSendable $sendable)
    {

        $domain = $this->option("domain");
        $view = $this->option("email");
        $subject = $this->option("subject");
        $test = $this->option("test");

        $perDay = 19000;

        if(empty($domain))
        {
            return $this->error("--domain= must be provided!");
        }

        if(empty($view))
        {
             return $this->error("--email= (view name) must be provided!");
        }

        if(empty($subject))
        {
             return $this->error("--subject='example subject' must be provided!");
        }

    

        if(! view()->exists("emails.visitor." . $view)) {
            return $this->error("--email= error! View cannot be found!");
        }


        $route = new Resolver($domain);

        $eventId  = $route->getEventId();

        $this->info("Event id: " . $eventId );

        //get all from this event and build a list....

        $repo->pushCriteria( new BelongsToGroup( $route->getGroupId() ));
        $repo->pushCriteria( new SortByDesc("id") );

        $all = $repo->all();

        $this->info("Found " . $all->count() . " records in the event group");

        $excludes = $all->where("event_id", $eventId )->pluck("email")->all();

        $this->info("Found " . count($excludes) . " records in current event");

        $sendable->checkUniqueness(true);

        $filtered =  $sendable->filter($all, $eventId, $excludes);

        $this->info( $filtered->count() . " can be notified" );

        $done = 0;

        foreach($filtered as $participant)
        {

            $email = (new EmailAddress($participant->email));

            if( ! $email->isValid() )
            {
                $this->error("Invalid email: " . (string) $email );
                continue;
            }

            if($done > $perDay){
                $this->error("Out of daily quota!");
                break;
            }

            dispatch( new Job( 
                $participant, 
                $eventId,
                compact("view", "subject") ) );

            if($test){
                $this->info("Dispatched test message!");
                break;
            }

            if($done % 100 === 0)
            {
                $this->info("Dispatched: " . $done);
            }

            $done++;
        }
       
        $this->info("All dispatched" );
    }





}
