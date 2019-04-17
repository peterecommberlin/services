<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Revivers\ParticipantSendable;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Models\ParticipantFields;
use Eventjuicer\Services\Personalizer;

class CompanyRepresentativesMessage extends Command
{

 
    protected $signature = 'exhibitors:reps-current-event 

        {--domain=} 
        {--email=} 
        {--subject=}
        {--lang=}
        {--defaultlang=} 
        {--throttle=1}';
    
    protected $description = 'Send general email message to Reps';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ParticipantSendable $sendable, CompanyData $cd)
    {


        $viewlang   = $this->option("lang");
        $defaultlang = $this->option("defaultlang");
        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");

        $errors = [];

        if(empty($viewlang)) {
            $errors[] = "--lang= must be set!";
        }


        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($subject)) {
            $errors[] = "--subject= must be set!";
        }
    
        
        if(empty($email)) {
            $errors[] = "--email= must be set!";
        }

        if(empty($defaultlang)) {
            $errors[] = "--defaultlang= must be set!";
        }

        $email = $email . "-" . $viewlang;

        if(! view()->exists("emails.company." . $email)) {
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

        $reps = $repo->get($eventId, "representative");

        $this->info("Number of reps: " . $reps->count() );

        $sendable->checkUniqueness(true);

        $sendable->setMuteTime(20); //minutes!!!!

        $reps = $sendable->filter($reps, $eventId);

        $this->info("Reps that can be notified: " . $reps->count() );

        $done = 0;

        $phones = array();

        foreach($reps as $rep)
        {
            //do we have company assigned?
            $phone = "";

            if(!$rep->company_id)
            {
               $this->error("No company assigned for " . $rep->email . " - skipped.");
               continue;
            }

           
            $companyProfile = $cd->toArray($rep->company);

            $lang = !empty($companyProfile["lang"]) ? $companyProfile["lang"] : $defaultlang;

            $event_manager = "";

            if(empty($companyProfile["password"])){
                $this->error("No password assigned for " . $rep->email . " - skipped.");
               continue;
            }

            if($lang !== $viewlang)
            {
                $this->info("Skipped! Lang mismatch. ");
                continue;
            }

            $query = ParticipantFields::where("participant_id", $rep->id)->where("field_id", 8)->get();

            if($query->count()){
                $phone = $query->first()->field_value;
                $phone = trim(preg_replace("/[^\+0-9]+/", "", $phone));
            }

            $profile = new Personalizer($rep);

            $fname = ucwords(
                str_replace(
                    array(",",";"), 
                    " ", 
                    $profile->translate("[[fname]]")
                )
            );

            $phones[] = '"'.$fname.'","'.$phone.'"';

            $this->info("Processing " . $rep->company->slug);

            $this->info("Notifying " . $rep->email);

            dispatch(new Job(
                $rep, 
                $eventId, 
                compact("email", "subject", "event_manager", "viewlang", "lang", "domain") 
            ));
            
            $done++;

             if(env("MAIL_TEST", false)){
                $this->line("Processing " . $rep->company->slug);
                break;
            }

        }

        $filename = "export".md5(time() . $eventId).".txt";

        file_put_contents(
            app()->basePath("storage/app/public/" . $filename), 
            implode( "\n", $phones )
        );

        $this->info("All done! " . "Check storage/" . $filename);   

        $this->info("Delivered " . $done . " messages");


    }
}
