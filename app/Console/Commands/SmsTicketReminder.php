<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Services\Resolver;
use Eventjuicer\Repositories\EloquentTicketRepository;
use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\WhereIn;
use Eventjuicer\Repositories\Criteria\RelEmpty;
use Eventjuicer\Models\ParticipantFields;
use Eventjuicer\Services\Personalizer;



class SmsTicketReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitors:sms-ticket-reminder 
        {--domain=} 
        {--prefix=}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        EloquentTicketRepository $ticketRepo, 
        ParticipantRepository $participantsRepo
    )
    {


        $domain = $this->option("domain");
        $prefix = $this->option("prefix");

        $errors = [];

        if(empty( $domain )) {
            $errors[] = "--domain= must be provided!";
        }

        if(empty( $prefix )) {
            $errors[] = "--prefix= default prefix must be provided!";
        }


        if(!empty($errors))
        {
            foreach($errors as $error){
                $this->error($error);
            }
            return;
        }



        $route = new Resolver($domain);

        $eventId =  $route->getEventId();

        $this->info("Event id: " . $eventId);

        $participantsByTicketRole = $ticketRepo->getParticipantsWithTicketRole("visitor", "event", $eventId);

        $participant_ids = $participantsByTicketRole->pluck("id")->all();

        $this->info("Total visitors: " . count($participant_ids) );

        $participantsRepo->pushCriteria(new WhereIn("id", $participant_ids));
        $participantsRepo->pushCriteria(new RelEmpty("ticketdownloads"));

        //it is pointless to preload relations as they will not be serialized by JOB dispatcher!
        $participants = $participantsRepo->all();

        $this->info("Visitors without a ticket: " . $participants->count() );

        $counter = 1;

        $phones = array();

        foreach($participants as $participant)
        {


            if(!filter_var($participant->email, FILTER_VALIDATE_EMAIL)){
                $this->error($participant->email);
                continue;
            }

            $query = ParticipantFields::where("participant_id", $participant->id)->where("field_id", 8)->get();

            if(!$query->count()){
                continue;
            }

            $phone = $query->first()->field_value;

           // $phone = str_replace([" ", "-", "."], "", $phone);

            $phone = trim(preg_replace("/[^\+0-9]+/", "", $phone));

            if(empty($phone) || strlen($phone) < 9){
                continue;
            }

            if(strpos($phone, "00") !== 0 && strpos($phone, "+") === false){
                $phone = $prefix . $phone;
            }

            $profile = new Personalizer($participant);

            $email = trim($participant->email);

            $fname = ucwords(
                str_replace(
                    array(","), " ", $profile->translate("[[fname]]")
                )
            );

            $phones[] = '"'.$email.'","'.$fname.'","'.$phone.'","https://'.$domain.'/ticket,'.$profile->translate("[[code]]").'"';

            if($counter % 100 === 0){

                $this->info("Dispatched " . $counter);
            }


            $counter++;
        }

        $filename = "export".md5(time() . $eventId).".txt";

        file_put_contents(
            app()->basePath("storage/app/public/" . $filename), 
            implode( "\n", $phones )
        );

        $this->info("All done! " . "Check storage/" . $filename);

        $this->info("Done. Dispatched jobs: " . $counter);

    }
}
