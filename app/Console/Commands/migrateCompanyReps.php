<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\SaveOrder;



use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;
use Eventjuicer\Repositories\Criteria\ColumnGreaterThanZero;
use Eventjuicer\Repositories\Criteria\WhereIn;

class migrateCompanyReps extends Command
{
   
    protected $signature = 'exhibitors:migrateReps {host}';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle(GetByRole $repo, ParticipantRepository $participants, SaveOrder $order)
    {

        $route = new Resolver( $this->argument("host") );

        $eventId =  $route->getEventId();
        $groupId = $route->getGroupId();

        $this->info("Current event id: " . $eventId);

        $exhibitors = $repo->get($eventId, "exhibitor", ["company.data"])->unique("company_id");

        $this->info("Number of exhibitors with unique companies assigned: " . $exhibitors->count() );

        $done = 0;

        //get companies that are PRESENT...
        $companies = $exhibitors->pluck("company_id")->all();

        //find previous event!
        $prev = $route->previousEvent();

        $this->info("Previous event id: " . $prev);

        $participants->pushCriteria(new BelongsToEvent($prev));
        $participants->pushCriteria(new ColumnGreaterThanZero("parent_id"));
        $participants->with(["fields", "parent"]);

        $oldSubaccounts = $participants->all();

        $this->info("Number of reps from previous event: " . $oldSubaccounts->count() );

        $repTicketId = 1;

        $whatWeDo  = $this->anticipate('Simulate or run?', ['simulate', 'run']);

        foreach($oldSubaccounts as $oldSub){

            $profile = $oldSub->profile();
            $profile["email"] = $oldSub->email;

            $company_id = !empty($oldSub->company_id) ? $oldSub->company_id : $oldSub->parent->company_id;

            if(empty($company_id)){
                $this->error("No company Id for: " . $oldSub->email );
                continue;
            }

            if(!in_array($company_id, $companies)){
                $this->info($oldSub->email . " Company lost?");
                continue;
            }

            if($whatWeDo === "simulate"){
                continue;
            }

           try {
               
            // $order->make(

            //     $eventId, 
            //     0, 
            //     $tickets, 
            //     $data["fields"],
            //     false,
            //     $this->user->user()->id
            
            // );

           } catch (Exception $e) {
               
           }
        }

        return;


        


        foreach($exhibitors as $ex)
        {
            
        
            //do we have company assigned?

            if(!$ex->company_id)
            {
                $this->error("No company assigned for " . $ex->email . " - skipped.");
                continue;
            }

          
            $this->info("Processing " . $ex->company->slug . " lang: " . $lang);

            $this->line("Fields with errors: " . implode(", ", array_keys($status)));

           

            $done++;

        }   

        $this->info("Counted " . $done . " companies with errors...");


    }
}


/*

  $data = $this->postData();

        if( empty( $data["ticket_id"] ) || empty( $data["fields"] ) ) 
        {
            return $this->jsonError("api.errors.registration.not_enough_data", 500);
        }

        $activeEventId = $this->user->activeEventId();

        $ticket = $ticketsRepo->find( $data["ticket_id"]);

        if( ! $ticket || ! $this->user->canAccess( $ticket ) ) {

            return $this->jsonError("api.errors.registration.bad_ticket_ids", 500);
        }

        $tickets = [];
        $tickets[$data["ticket_id"]] = 1;


        //company name should be cloned from company! :)

        $companyData = $this->user->companyData();

        $data["fields"]["cname2"] = array_get($companyData, "name");

        try {
            
            $order->make(

                $activeEventId, 
                0, 
                $tickets, 
                $data["fields"],
                false,
                $this->user->user()->id
            
            );

            $participant = $order->getParticipant();
            
            $personalizer = new Personalizer($participant);

            return new CompanyRepresentativeResource($participant);


        } catch (Exception $e) {
            
            return $this->jsonError($e->getMessage(), 500);
        }

        

        */
