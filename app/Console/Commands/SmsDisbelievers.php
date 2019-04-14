<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\ParticipantRepository;

use Eventjuicer\Repositories\Criteria\BelongsToGroup;
use Eventjuicer\Repositories\Criteria\BelongsToOrganizer;
use Eventjuicer\Repositories\Criteria\SortByDesc;
use Eventjuicer\Repositories\Criteria\WhereIn;

use Eventjuicer\Services\Revivers\ParticipantSendable;

use Eventjuicer\Models\ParticipantFields;

class SmsDisbelievers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitors:sms-to-old-events 

        {--domain=} 
        {--prefix=}
        {--limit=}
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
        $prefix = $this->option("prefix");
        $limit = $this->option("limit");
        $events = $this->option("events");

        $errors = [];

        if(empty( $domain )) {
            $errors[] = "--domain= must be provided!";
        }

        if(empty( $prefix )) {
            $errors[] = "--prefix= default prefix must be provided!";
        }

        if(empty( $events )) {
            $errors[] = "--events= default prefix must be provided!";
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

        if( $events === "all"){

            $scope = $this->anticipate('Define scope group/organizer: ', ['group', 'organizer']);

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

        //as we will ignore doubles in SMSAPI
        $sendable->checkUniqueness(false);
        //as we control it some where else!
        $sendable->checkDeliveries(false);

        $filtered =  $sendable->filter($all, $eventId, $excludes);

        $this->info( "Found " . $filtered->count() . " unique records checked by emails..." );

        $done = 0;

        $phones = array();

        foreach($filtered as $participant)
        {
            $query = ParticipantFields::where("participant_id", $participant->id)->where("field_id", 8)->get();

            if(!$query->count()){
                continue;
            }

            if(!filter_var(trim($participant->email), FILTER_VALIDATE_EMAIL)){

                $this->error("bad email: " . $participant->email . "..skipping!");
                continue;
            }

            $phone = $query->first()->field_value;

           // $phone = str_replace([" ", "-", "."], "", $phone);

            $phone = trim(preg_replace("/[^\+0-9]+/", "", $phone));

            if(empty($phone) || strlen($phone) < 9){
                continue;
            }

            if(strpos($phone, "00") !== 0 && strpos($phone, "+") === false){
                $phone = $prefix . $phone;
            }

            // if(!empty($limit) && $limit !== "*" &&  
            //     strpos($phone, "00".$limit) ===false && 
            //     strpos($phone, "+".$limit)===false
            // ){
            //     continue;
            // }

            $phones[] = $phone;

            if($done % 1000 === 0)
            {
                $this->info("Dispatched: " . $done);
            }

            $done++;
        }

        $filename = "export".md5(time() . $eventId).".txt";

        file_put_contents(
            app()->basePath("storage/app/public/" . $filename), 
            implode( "\n", $phones )
        );

        $this->info("All done! " . "Check storage/" . $filename);
    }





}
