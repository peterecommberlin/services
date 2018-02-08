<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Repositories\MeetupRepository;
use Eventjuicer\Repositories\Criteria\ColumnIsNull;
use Eventjuicer\Repositories\Criteria\ColumnLessThan;

use App\Jobs\Meetups\BulkNotify;
use Eventjuicer\Services\Meetups\Sendable;

class SendBulkMeetupRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meetups:bulk';

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
    public function handle(MeetupRepository $meetups)
    {
       

        $meetups->pushCriteria(new ColumnIsNull("responded_at"));
        $meetups->pushCriteria(new ColumnLessThan("retries", 3));

        $all = $meetups->all();

        $this->info("Found: " . $all->count() . " meetups.");

        $filtered = $all->filter(function($meetup){

            return (bool) (new Sendable($meetup))->check();

        });

        $grouped = $filtered->groupBy("participant_id");

        foreach($grouped as $meetupsColl)
        {
            $this->info("Dispatching notification(s) for: " . $meetupsColl->first()->participant->email . ". Requests: " . $meetupsColl->count() );
            dispatch(new BulkNotify($meetupsColl));
        }

        $this->info("Dispatched: " . $grouped->count() . " jobs.");

    }
}
