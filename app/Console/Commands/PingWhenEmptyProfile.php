<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



// use Eventjuicer\Services\Resolver;
// use Eventjuicer\Services\GetByRole;
// 
// use Eventjuicer\Services\Revivers\ParticipantSendable;
// use Eventjuicer\ValueObjects\EmailAddress;

use Eventjuicer\Jobs\PingWhenEmptyProfileJob as Job;
use Eventjuicer\Services\CompanyData;
use Eventjuicer\Services\Exhibitors\Console;

/*
Das Ausstellerprofil muss vervollständigt werden
//https://github.com/eventjuicer/admin/issues/3

changes
===========================
use event_manager as CC contact
handle language differently

*/

class PingWhenEmptyProfile extends Command
{

 
    protected $signature = 'companies:emptyprofile 
      {--domain=}
      {--maxold=1}
      {--defaultlang=}

    ';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(Console $service, CompanyData $cd)
    {


        $service->setParams($this->options());


        $whatWeDo  = $this->anticipate('Send or stats?', ['send', 'stats']);

        $domain     = $this->option("domain");
        $maxold     = $this->option("maxold");
        $defaultlang     = $this->option("defaultlang");


        $errors = array();

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if($whatWeDo === "send"){

            if(empty($maxold)) {
                $errors[] = "--maxold= must be set!";
            }

            if(empty($defaultlang)) {
                $errors[] = "--defaultlang= must be set!";
            }

            if(empty($email)) {
                $errors[] = "--email= must be set!";
            }


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

        $service->run($domain);

        $eventId =  $service->getEventId();

        $this->info("Event id: " . $eventId );

        $exhibitors = $service->getDataset(true);

        $this->info("Number of exhibitors with companies assigned: " . $exhibitors->count() );

        $filtered = $service->getSendable();

        $this->info("Exhibitors that can be notified: " . $filtered->count() );


        $done = 0;


    

        foreach($exhibitors as $ex)
        {
            
        
            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }


            $lang           = $ex->getLang();
            $name           = $ex->getName();
            $event_manager  = $ex->getEventManager();


            $status = $cd->status( $ex->getModel()->company);

            if(!count($status))
            {
                continue;
            }

            $this->line("----");
            $this->info("Processing " . $name . " lang: " . $lang);


            $this->line("Fields with errors: " . implode(", ", array_keys($status)));

            if($whatWeDo === "send")
            {
                $this->info("Notifying " . $ex->email);
                $this->line("----");

                dispatch(new Job($ex->getModel(), $eventId, $lang, $event_manager, $domain));
            }

            $done++;

        }   

        $this->info("Counted " . $done . " companies with errors...");


    }
}
