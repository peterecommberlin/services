<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Exhibitors\Console;
use Eventjuicer\Services\SaveOrder;
use Eventjuicer\Repositories\MeetupRepository;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;
use Eventjuicer\Repositories\Criteria\FlagEquals;



class SyncMeetupsToVip extends Command
{

 
    protected $signature = 'meetups:vip

        {--domain=} 
       
       ';
    
    protected $description = 'Map confirmed meetups to VIP';
 
    public function __construct(){
        parent::__construct();
    }
 
    public function handle(MeetupRepository $meetups, Console $service, SaveOrder $saveorder)
    {

        $domain     = $this->option("domain");
       
        $errors = [];

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }


        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }

            /**
            LET'S FUCKING START!
        **/

        $service->run($domain);

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        $meetups->pushCriteria(new BelongsToEvent($eventId));
        $meetups->pushCriteria(new FlagEquals("agreed", 1));
        $dataset = $meetups->all();

        $this->info("Number of meetups scheduled: " . $dataset->count());

        $unique = $dataset->unique("participant_id");

        $this->info("Number of unique participants: " . $unique->count());

        $done = 0;

        foreach( $unique as $meetup)
        {
            $participant = $meetup->participant;

            $this->line("Processing " . $participant->email . " ID: " . $participant->id);

            $saveorder->setParticipant( $participant );

            $saveorder->makeVip("meetup");

            $participant->fresh();

            $this->line("important? " . $participant->important);

            $done++;

        }   

        $this->info("Upgraded: " . $done . "");


    }
}
