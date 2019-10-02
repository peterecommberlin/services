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

        $whatWeDo  = $this->anticipate('Sync or status?', ['sync', 'status']);

        foreach($query as $p)
        {

            // dd($p->fieldpivot->toArray());

            $profile = new Personalizer($p);

            $logotype = trim($profile->translate("[[logotype]]"));
            $avatar = trim($profile->translate("[[avatar]]"));
            $logotypeStatus = ($logotype && stripos($logotype, "http") !== false);
            $avatarStatus = ($avatar && stripos($avatar, "http") !== false);

            if(!$logotypeStatus)
            {
                 $this->error("No logotype for: "  . $p->email . " (ID: " .$p->id.")");
            }

            if(!$avatarStatus)
            {
                 $this->error("No avatar for: "  . $p->email . " (ID: " .$p->id.")");
            }

            if(!$logotypeStatus && !$avatarStatus){
                $done++;
                continue;
            }

            if($whatWeDo === "sync"){
                dispatch(new Job($p));
            }     
            
        
        }   

        $this->info("Counted " . $done . " with errors...");


    }
}
