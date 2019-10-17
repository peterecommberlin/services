<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Models\ParticipantFields;

class ContestantsMoveVotes extends Command
{

    protected $votes = 53; //votes!
    protected $votes_override = 213;
    protected $votes_earned = 256;

    protected $signature = 'contestants:votes {--domain=}';
    protected $description = 'show and save votes...';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo)
    {
        $domain    = $this->option("domain");

        $errors = array();

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }

        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $contestants = $repo->get($eventId, "contestant", ["votes","fieldpivot"]);

        $zero = 0;
        $total = 0;
        $updates = 0;

        foreach($contestants as $p)
        {

            $no_of_votes = $p->votes ? $p->votes->count() : 0;

            if($no_of_votes){

                $total = $total + $no_of_votes;

                $this->line($p->email . " id: " . $p->id . " votes: ". $no_of_votes);

            }else{

                $zero++;

                $this->error($p->email . " id: " . $p->id . " no votes :(");

            }

            //get override

            $votes_override = ParticipantFields::where([
             "participant_id" => $p->id,
             "field_id" => $this->votes_override
            ])->get()->first();

            $votes_earned = ParticipantFields::firstOrNew([
                "participant_id" => $p->id,
                "field_id" => $this->votes_earned
            ]);


            // if(!$votes_earned || !is_numeric($votes_earned->field_value) || $votes_earned->field_value != $no_of_votes){

                $votes_earned->participant_id = $p->id;
                $votes_earned->field_id  = $this->votes_earned;
                $votes_earned->field_value = $no_of_votes;
                $votes_earned->organizer_id = $p->organizer_id;
                $votes_earned->group_id = $p->group_id;
                $votes_earned->event_id = $p->event_id;
                $votes_earned->updatedon = date("Y-m-d H:i:s");
                $votes_earned->archive = "";

                $votes_earned->save();
            

                //update TOTAL VALUE

                $votes = ParticipantFields::firstOrNew([
                    "participant_id" => $p->id,
                    "field_id" => $this->votes
                ]);


                $votes->participant_id = $p->id;
                $votes->field_id  = $this->votes;
                $votes->field_value = $votes_override ? $no_of_votes + intval($votes_override->field_value) : $no_of_votes ;
                $votes->organizer_id = $p->organizer_id;
                $votes->group_id = $p->group_id;
                $votes->event_id = $p->event_id;
                $votes->updatedon = date("Y-m-d H:i:s");
                $votes->archive = "";

                $votes->save();



                $updates++;



           // }
        


        }   

        $this->line("Current event id: " . $eventId);
        $this->line("Number of records: " . $contestants->count() );
        $this->line("" . $updates . " contestants updated.");
        $this->info("" . $zero . " NOT participating.");
        $this->info("" . $total . " votes.");


    }
}
