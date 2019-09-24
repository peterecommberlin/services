<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\CallForPapersMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Models\Field;

class CallForPapersMessage extends Command
{

 
    protected $signature = 'callforpapers:msg 

        {--domain=} 
        {--email=callforpaper} 
        {--subject=}
        {--filter_field=}
        {--filter_value=} 
    
    ';
    
    protected $description = 'Send general email message to contestants';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ParticipantSendable $sendable)
    {


        $filter_field   = $this->option("filter_field");
        $filter_value = $this->option("filter_value");

        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");

        $errors = [];

     
        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($subject)) {
            $errors[] = "--subject= must be set!";
        }
    
        
        if(empty($email)) {
            $errors[] = "--email= must be set!";
        }

        if(! view()->exists("emails.participants." . $email)) {
            $errors[] = "--email= error. View cannot be found!";
        }

        //get field!

        if(!empty($filter_field) && is_null($filter_value) ) {
            $errors[] = "--filter_value= must be set when using --filter_field !";
        }

        $field = Field::where("name", $filter_field)->first();
        $field_id =  $field ? $field->id : 0;

        if(!empty($filter_field) && !$field_id){
            $errors[] = "--filter_field= error. Cannot find such field!";
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


        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $participants = $repo->get($eventId, "contestant", ["fieldpivot", "votes"]);

        $sendable->checkUniqueness(false);

        $sendable->setMuteTime(20); //minutes!!!!

        $participants = $sendable->filter($participants, $eventId);

        $this->info("Filtered participants that can be notified: " . $participants->count() );

        $done = 0;

        $whatWeDo  = $this->anticipate('Send or stats?', ['send', 'stats']);

        foreach($participants as $p)
        {

            $votes = (int) $p->votes->count();

            //do we have company assigned?

            if($field_id){

                //compare with field pivot
                $lookup = $p->fieldpivot->where("field_id", $field_id)->first();

                $current_value = $lookup ? $lookup->field_value : null;

                if(!$lookup || (!is_null($current_value) && $current_value != $filter_value)){
                    $this->error("Bad field_value (".$lookup->field_value.") ...skipping");

                    continue;
                }
            }
          

            if($whatWeDo === "send"){
                $this->line("Notifying " . $p->email . " Votes: " . $votes);
                
                dispatch(new Job(
                    $p, 
                    $eventId, 
                    compact("email", "subject", "domain", "votes") 
                 ));
            }

          
            
            $done++;

        }   

        $this->info("Delivered " . $done . " messages");


    }
}
