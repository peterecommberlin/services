<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Repositories\MeetupRepository;
use Eventjuicer\Repositories\Criteria\ColumnIsNull;
use Eventjuicer\Repositories\Criteria\ColumnLessThan;
use Eventjuicer\Repositories\Criteria\ColumnGreaterThan;

use App\Jobs\Meetups\BulkNotify;
use Eventjuicer\Services\Meetups\Sendable;
use Eventjuicer\ValueObjects\EmailAddress;

use Carbon\Carbon;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\GetByRole;

class SendBulkMeetupRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meetups:bulk {meetupId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send info to people!';

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
    public function handle(MeetupRepository $meetups, GetByRole $roles, ParticipantSendable $sendable)
    {
        $meetupId = $this->argument('meetupId');

        if(is_numeric($meetupId))
        {
            $meetup = $meetups->find($meetupId);
            if($meetup)
            {
                dispatch(new BulkNotify( collect([])->push($meetup)  ));
                $this->info("Test dispatched!");
            } 
            return;
        }

        //skip already confirmed
        $meetups->pushCriteria(new ColumnIsNull("responded_at"));

        //only when sent 0,1,2 times
        $meetups->pushCriteria(new ColumnLessThan("retries", 3));

        //skip some lost old ones....
        $meetups->pushCriteria(new ColumnGreaterThan("created_at", 

            Carbon::now()->subMonth()
        ));

        
        $all = $meetups->all();

        $this->info("Found: " . $all->count() . " open meetups.");

        $filtered = $all->filter(function($meetup){

            return (bool) (new Sendable($meetup))->check();

        });

        $groupedByParticipant = $filtered->groupBy("participant_id");


        /*
        //we need event id to check if we can upset people

        $eventIds = $filtered->pluck("event_id")->unique()->all();

        //get all participants !

        $participants = $roles->getParticipantsByIds(
            $filtered->pluck("participant_id")->unique()->all()
        )->keyBy("id");

        // $participants = $roles->getParticipantsByIds([]);

        // $sendable->checkUniqueness(false);

        // $sendable->setMuteTime(60); //minutes!!!!

        // $filtered = $sendable->filter($participants, $eventId);

        */

        foreach($groupedByParticipant as $meetupsColl)
        {

            $email = $meetupsColl->first()->participant->email;

            if( ! (new EmailAddress($email))->isValid() )
            {
                $this->error("Email address invalid: " . $email);
                continue;
            }

            $this->info("Dispatching notification(s) for: " . $email . ". Requests: " . $meetupsColl->count() );
            dispatch(new BulkNotify($meetupsColl));
        }

        $this->info("Dispatched: " . $groupedByParticipant->count() . " jobs.");

    }
}
