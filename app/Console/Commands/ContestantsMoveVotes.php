<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Models\ParticipantFields;

class ContestantsMoveVotes extends Command
{

    protected $field_id = 53; //votes!
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

        $this->info("Current event id: " . $eventId);

        $contestants = $repo->get($eventId, "contestant", ["votes","fieldpivot"]);

        $this->info("Number of records: " . $contestants->count() );

        $zero = 0;
        $more_than_zero = 0;
        $updates = 0;

        foreach($contestants as $p)
        {

            $no_of_votes = $p->votes ? $p->votes->count() : 0;

            if($no_of_votes){

                $more_than_zero++;

                $this->info($p->email . " id: " . $p->id . " votes: ". $no_of_votes);

            }else{

                $zero++;

                $this->line($p->email . " id: " . $p->id . " no votes :(");

            }

            $field = ParticipantFields::firstOrNew([
                "participant_id" => $p->id,
                "field_id" => $this->field_id
            ]);

            if(!$field || !is_numeric($field->field_value) || $field->field_value != $no_of_votes){

                $field->participant_id = $p->id;
                $field->field_id  = $this->field_id;
                $field->field_value = $no_of_votes;
                $field->organizer_id = $p->organizer_id;
                $field->group_id = $p->group_id;
                $field->event_id = $p->event_id;
                $field->updatedon = date("Y-m-d H:i:s");
                $field->archive = "";

                $field->save();
            
                $updates++;
            }
        


        }   

        $this->info("" . $updates . " contestants updated.");


    }
}
