<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Jobs\SendParticipantImageToCloudinaryJob as Job;


class CdnizeParticipantImages extends Command
{

 
    protected $signature = 'presenters:cdnize {host}';
    protected $description = 'send participant images to CDN... params host role';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo)
    {

        $route = new Resolver( $this->argument("host") );

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $query = $repo->get($eventId, "presenter", "profile");

        $this->info("Number of records: " . $query->count() );

        $done = 0;

        foreach($query as $p)
        {

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
