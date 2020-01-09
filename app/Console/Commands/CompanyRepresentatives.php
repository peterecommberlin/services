<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Jobs\CompanyRepresentativesJob as Job;
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

        $whatWeDo  = $this->anticipate('Send, stats?', ['send', 'stats']);

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

            if($viewlang && ! view()->exists("emails.company." . $email . "-" . $viewlang)) {
            $errors[] = "--email= error. View cannot be found!";
            }
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



        $service->run($domain);

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        $exhibitors = $service->getDataset(true);

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $filtered = $service->getSendable();

        $this->info("Exhibitors that can be notified: " . $filtered->count() );

        $iterate = ($whatWeDo === "send") ? $filtered : $exhibitors;

        $done = 0;

        foreach($iterate as $ex)
        {   

            //do we have company assigned?

            if( !$ex->company_id ){
                $this->error( "No company assigned for " . $ex->email );
                continue;
            }

            if( !$ex->hasAccountManager() ){
                $this->error( "No account assigned for " . $ex->getName() );
                continue;
            }

            $lang           = $ex->getLang();
            $name           = $ex->getName();
            $event_manager  = $ex->getEventManager();
            $cReps          = $ex->getReps();

            if($cReps->count() >= $threshold){
                 continue;
            }

            $this->info("Processing " . $name . " lang: " . $lang);

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
                        $ex, 
                        $cReps, 
                        $eventId,
                        array(
                            "viewlang" => $viewlang, 
                            "event_manager" => $event_manager,
                            "subject" => $subject,
                            "view" => $email
                        )
                ));
            }

            $done++;

        }   

        $this->info("Counted " . $done . " companies with reps <= " . $threshold);


    }
}
