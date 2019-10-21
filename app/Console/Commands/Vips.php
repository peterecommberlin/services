<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;

use Eventjuicer\ValueObjects\EmailAddress;
use Eventjuicer\Services\SaveOrder;
use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;

use Eventjuicer\Repositories\MeetupRepository;
use Eventjuicer\Repositories\Criteria\FlagEquals;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;

class Vips extends Command {

    protected $signature = 'visitors:vips

        {--domain=}
        {--email=}
        {--subject=}
       
    ';
    
    protected $description = 'Get the list of VIPs';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(MeetupRepository $meetups, CompanyData $cd, SaveOrder $saveorder)
    {
       
        $domain = $this->option("domain");
        $email = $this->option("email");
        $subject = $this->option("subject");

        $errors = [];

        $whatToDo = $this->anticipate("Email, report, both", ["send","report", "all"]);


        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if($whatToDo !== "report" && empty($subject)) {
            $errors[] = "--subject= must be set!";
        }
    
        if($whatToDo !== "report" && empty($email)) {
            $errors[] = "--email= must be set!";
        }

         if($whatToDo !== "report" && $email && ! view()->exists("emails.visitor." . $email)) {
            $errors[] = "--email= error. View cannot be found!";
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

        $meetups->pushCriteria(new BelongsToEvent($eventId));
        $meetups->pushCriteria(new FlagEquals("agreed", 1));
        $vips = $meetups->with(["participant.fields"])->all()->unique("participant_id");

        $this->info("Number of unique VIPs: " . $vips->count() );

        $done = 0;


        foreach($vips as $vip)
        {

            $participant = $vip->participant;

            $errors = array();

            $details = (new Personalizer($participant))->translate("[[fname]] [[lname]] [[cname2]]");
            
            $this->line($details);
            
            $done++;

        }   

        $this->info("Done " . $done . "");


    }
}
