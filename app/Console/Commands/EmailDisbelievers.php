<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\ParticipantRepository;

use Eventjuicer\Repositories\Criteria\BelongsToGroup;
use Eventjuicer\Repositories\Criteria\BelongsToOrganizer;
use Eventjuicer\Repositories\Criteria\SortByDesc;
use Eventjuicer\Repositories\Criteria\WhereIn;

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
    protected $signature = 'visitors:restore-from-old-events 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--throttle=}
        {--events=all}
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
        $throttle = $this->option("throttle");
        $events = $this->option("events");


        $errors = [];

        if(empty( $domain )) {
            $errors[] = "--domain= must be provided!";
        }
     
        if(empty( $view )) {
            $errors[] = "--email= (view name) must be provided!";
        }

        if(empty( $subject )) {
            $errors[] = "--subject='example subject' must be provided!";
        }

        if(!is_numeric( $throttle )) {
            $errors[] = "--throttle=NUMBER must be provided! set 0 for OFF";
        }


        if(empty( $events )) {
            $errors[] = "--events= default prefix must be provided!";
        }

        if(! view()->exists("emails.visitor." . $view)) {
            $errors[] = "--email= error! View cannot be found!";
        }


        if(!empty($errors))
        {
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }

        $route          = new Resolver($domain);
        $eventId        = $route->getEventId();
        $group_id       = $route->getGroupId();
        $organizer_id   = $route->getOrganizerId();

        if($events === "all"){

            $scope = $this->choice('Define Scope?', ['group', 'organizer'], 0);

            if($scope === "organizer")
            {
                $this->info("Scope: organizer.");
                $repo->pushCriteria( new BelongsToOrganizer( $organizer_id ));
            }
            else
            {
                $this->info("Scope: group.");
                $repo->pushCriteria( new BelongsToGroup( $group_id ));
            }


        }else{

            $this->info("Scope: limited to events with IDs - " . $events);

            $repo->pushCriteria( new WhereIn("event_id", explode(",", $events) ));
        }
        
        $repo->pushCriteria( new SortByDesc("id") );

        $all = $repo->all();

        $this->info("Found " . $all->count() . " records in the this scope!");

        $excludes = $all->where("event_id", $eventId )->pluck("email")->all();

        $this->info("Skipping " . count($excludes) . " matches with active event...");

        $sendable->checkUniqueness(true);
        $sendable->setMuteTime(24 * 60); //24h


        $filtered =  $sendable->filter($all, $eventId, $excludes);

        $this->info( "Found " . $filtered->count() . " unique emails..." );

        $done = 0;

        foreach($filtered as $participant)
        {

            $email = (new EmailAddress($participant->email));

            if( ! $email->isValid() )
            {
                $this->error("Invalid email: " . (string) $email );
                continue;
            }

            if($done >  $throttle ){
                $this->error("Out of daily quota!");
                break;
            }

            dispatch( new Job( 
                $participant, 
                $eventId,
                compact("view", "subject") ) );

            if(env("MAIL_TEST", false)){
                $this->info("Dispatched test message!");
                break;
            }

            if($done % 1000 === 0)
            {
                $this->info("Dispatched: " . $done);
            }

            $done++;
        }
       
        $this->info("All dispatched" );
    }





}
