<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Jobs\SendParticipantImageToCloudinaryJob as Job;


class CdnizeParticipantImages extends Command
{

 
    protected $signature = 'participants:cdnize {--domain=} 
        {--role=} ';
    protected $description = 'send participant images to CDN';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo)
    {
        $domain    = $this->option("domain");
        $role      = $this->option("role");

        $errors = array();

        if(empty($domain)) {
            $errors[] = "--domain= must be set!";
        }

        if(empty($role)) {
            $errors[] = "--role= must be set!";
        }
    
        if(count($errors)){
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }


        $route = new Resolver( $domain );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $query = $repo->get($eventId, $role, ["fields"]);

        $this->info("Number of records: " . $query->count() );

        $done = 0;

        foreach($query as $p)
        {

            // dd($p->fieldpivot->toArray());

            $profile = new Personalizer($p);

            $images = trim($profile->translate("[[logotype]][[avatar]]"));

            if(!$images)
            {
                 $this->error("No images for: "  . $p->email);
            }

            $this->info("Dispatching job for: " . $p->email);

            dispatch(new Job($p));
            
            $done++;

        }   

        $this->info("Counted " . $done . " participants with images...");


    }
}
