<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use Eventjuicer\Services\Resolver;
use Eventjuicer\Services\GetByRole;
use Eventjuicer\Services\SaveOrder;

use Eventjuicer\Models\Ticket;

use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\BelongsToEvent;
use Eventjuicer\Repositories\Criteria\ColumnGreaterThanZero;
use Eventjuicer\Repositories\Criteria\WhereIn;

class migrateCompanyReps extends Command
{
   
    protected $signature = 'exhibitors:migrateReps {host} {ticketId}';
    protected $description = 'Command description';
 
    public function __construct()
    {
        parent::__construct();
    }


    protected function getSubsFromPrevEvent($repo, $prev){

        $repo->makeModel();

        $repo->pushCriteria(new BelongsToEvent($prev));
        $repo->pushCriteria(new ColumnGreaterThanZero("parent_id"));
        $repo->with(["fields", "parent"]);

        return $repo->all();

    }

     protected function getSubsFromCurrentEvent($repo, $eventId){

        $repo->makeModel();
        $repo->pushCriteria(new BelongsToEvent($eventId));
        $repo->pushCriteria(new ColumnGreaterThanZero("parent_id"));
        return $repo->all()->pluck("email")->all();

    }

 
    public function handle(GetByRole $repo, ParticipantRepository $participants, SaveOrder $order)
    {

        $route = new Resolver( $this->argument("host") );
        $ticketId = $this->argument("ticketId");

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

        $oldSubaccounts = $this->getSubsFromPrevEvent($participants,  $prev);

        $this->info("Number of reps from previous event: " . $oldSubaccounts->count() );

        $currentSubaccounts = $this->getSubsFromCurrentEvent($participants,  $eventId);

        $this->info("Number of reps from current event: " . count($currentSubaccounts) );

        if(Ticket::find($ticketId)->event_id != $eventId){
            $this->error("Rep Ticket ID must be from current event!!!!");
            return;
        }

        $whatWeDo  = $this->anticipate('Simulate or run?', ['simulate', 'run']);

        foreach($oldSubaccounts as $oldSub){

            $profile = $oldSub->profile();
            $profile["email"] = strtolower(trim($oldSub->email));

            $company_id = !empty($oldSub->company_id) ? $oldSub->company_id : $oldSub->parent->company_id;

            if(empty($company_id)){
                $this->error("No company Id for: " . $oldSub->email );
                continue;
            }

            if(!in_array($company_id, $companies)){
                $this->line($oldSub->email);
                continue;
            }

            //we shall avoid doubles...

            if(in_array($oldSub->email, $currentSubaccounts)){
                $this->error("Already added!" . $oldSub->email );
                continue;
            }

            //try to determine PARENT

            $exh = $exhibitors->where("company_id", $company_id)->first();

            if(is_null($exh)){
                $this->error("Cannot assign current exhibitor!" . $oldSub->email );
                continue;
            }

            if($whatWeDo === "simulate"){

                $this->line($oldSub->email . " to " . $exh->email);

                continue;
            }

            //always ec

           try {
               
            $order->make(
                $eventId, 
                0, 
                [ $ticketId => 1], 
                $profile,
                false,
                $exh->id            
            );

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
