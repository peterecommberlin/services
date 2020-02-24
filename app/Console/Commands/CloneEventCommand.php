<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Models\Event;
use Carbon\Carbon;

class CloneEventCommand extends Command {

   
    protected $signature = 'event:clone {--source=} {--target=0}';
    protected $description = 'event:clone --source=ID --target=0';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo)
    {
        $source    = (int) $this->option("source");
        $target    = (int) $this->option("target");

        $errors = array();

        if(empty($source)) {
            $errors[] = "--source= must be set!";
        }

        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }

        $oldEvent = Event::findOrFail($source);

        if(!$target){
            $newEvent = $oldEvent->replicate();
            $newEvent->names = "CLONE of " . $oldEvent->names;
            $newEvent->save();

            $this->line("Target event ID " . $newEvent->id);

        }else{
            $newEvent = Event::findOrFail($target);
        }
     

        //clone ticket groups

        $ticketGroupsMappings = [];

        foreach($oldEvent->ticketgroups AS $old_ticket_group){
            $new_ticket_group = $old_ticket_group->replicate();
             //update ticket id
            $new_ticket_group->event_id = $newEvent->id;
            $new_ticket_group->save();

            $ticketGroupsMappings[$old_ticket_group->id] = $new_ticket_group->id;
        }


        $this->line("Ticket group mappings:" . json_encode($ticketGroupsMappings) );


        //clone tickets!

        $ticketMappings = [];

        foreach($oldEvent->tickets AS $old_ticket){
            $new_ticket = $old_ticket->replicate();
            //update ticket id
            $new_ticket->event_id = $newEvent->id;
            //update ticket group!
            if(isset($ticketGroupsMappings[$old_ticket->ticket_group_id])){
                $new_ticket->ticket_group_id = $ticketGroupsMappings[$old_ticket->ticket_group_id];
            }else{
                $new_ticket->ticket_group_id = 0;
            }

            //update names ...

            $names = $new_ticket->names;
            foreach($names AS  &$name){
                $name = "CLONED " . $name;
            }

            $new_ticket->names = $names;
            //reset descriptions
            $new_ticket->descriptions = [];

            //correct time
            $new_ticket->start = (string) Carbon::now();
            $new_ticket->end = (string) Carbon::now();

            //reset not needed info

            $new_ticket->additional_message = "";

            $new_ticket->save();

            $ticketMappings[$old_ticket->id] = $new_ticket->id;

        }

        $this->line("Ticket group mappings:" . json_encode($ticketMappings) );


        foreach($oldEvent->fieldsets AS $old_fieldset){
           
            //update ticket!

            if(isset($ticketMappings[$old_fieldset->ticket_id])){
                $new_fieldset = $old_fieldset->replicate();
                $new_fieldset->event_id = $newEvent->id;
                $new_fieldset->ticket_id = $ticketMappings[$old_fieldset->ticket_id];
                $new_fieldset->save();
            }
        }




        return;



    }
}
