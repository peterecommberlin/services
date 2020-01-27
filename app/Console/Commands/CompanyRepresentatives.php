<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Jobs\GeneralExhibitorMessageJob as Job;
use Eventjuicer\Services\Exhibitors\Console;

class CompanyRepresentatives extends Command
{

 
    protected $signature = 'exhibitors:reps 
        {--domain=} 
        {--email=} 
        {--subject=}
        {--threshold=}
        {--lang=}
        {--defaultlang=}';

    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service){

        $service->setParams($this->options());

        $errors = [];

        $viewlang   = $this->option("lang");
        $defaultlang= $this->option("defaultlang");

        $domain     = $this->option("domain");
        $email      = $this->option("email");
        $subject    = $this->option("subject");
        $threshold  = $this->option("threshold");

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($threshold)) {
            $errors[] = "--threshold= must be set!";
        }


        if(count($errors)){

            foreach($errors as $error){
                $this->error($error);
            }

            return;
        }

        $whatWeDo  = $this->anticipate('Send, stats?', ['send', 'stats']);
        $role  = $this->anticipate('representative, party?', ['representative', 'party']);

        if($whatWeDo === "send"){

            if(empty($viewlang)) {
                $errors[] = "--lang= must be set!";
            }

            if(empty($defaultlang)) {
                $errors[] = "--defaultlang= must be set!";
            }


            if(empty($subject)) {
                $errors[] = "--subject= must be set!";
            }

            if(empty($email)) {
                $errors[] = "--email= must be set!";
            }

            $email = $email . "-" . $viewlang;

            if($viewlang && ! view()->exists("emails.company." . $email)) {
                $errors[] = "--email= error. View cannot be found!";
            }
        }
 


        if(count($errors)){

            foreach($errors as $error){
                $this->error($error);
            }

            return;
        }



        $service->run($domain);

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        $exhibitors = $service->getDataset(true);

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $filtered = $service->getSendable();

        $allTranslations = $service->getTranslations();

        $this->info($role . " reps that can be notified: " . $filtered->count() );

        $iterate = ($whatWeDo === "send") ? $filtered : $exhibitors;

        $done = 0;
        $noreps = 0;
        $noaccount = 0;

        foreach($iterate as $ex)
        {   

            //do we have company assigned?

            if( !$ex->company_id ){
                $this->error( "No company assigned for " . $ex->email );
                continue;
            }

            if( !$ex->hasAccountManager() ){
                $this->error( "No account assigned for " . $ex->getName() );
                $noaccount++;
                continue;
            }

            $lang           = $ex->getLang();
            $name           = $ex->getName();
            $event_manager  = $ex->getEventManager();
            $cReps          = $ex->getReps($role);
            $translations   = array_get($allTranslations, $lang);

            if(!$cReps->count()){
                $noreps++;
            }

            if($cReps->count() >= $threshold){
                 continue;
            }

            $this->info("Processing " . $ex->email . " lang: " . $lang);

            if(empty($name)){
                 $this->error("No company name!");
            }

            if($whatWeDo !== "send"){

                if(!$cReps->count()){
                    $this->error("No reps!");
                }else{
                    $this->line("Reps: " . $cReps->count());
                }

                continue;
            }
    
        
            if($whatWeDo == "send")
            {

                if($lang !== $viewlang)
                {
                    $this->line("Skipped! Lang mismatch. ");
                    continue;
                }

                $this->info("Notified");

                dispatch(new Job(
                        $ex->getModel(), 
                        $eventId,
                        array(
                            "email" => $email,
                            "viewlang" => $viewlang, 
                            "lang" => $lang,
                            "event_manager" => $event_manager,
                            "subject" => $subject,
                            "domain" => $domain,
                            "translations" => $translations,
                            "representatives" =>  $cReps,
                           
                        )


                       
                ));
            }

            $done++;

        }   

        $this->info("Counted " . $noreps . " without reps!");

        $this->info("Counted " . $noaccount . " without account manager ");

        $this->info("Processed " . $done . " companies with reps <= " . $threshold);


    }
}
