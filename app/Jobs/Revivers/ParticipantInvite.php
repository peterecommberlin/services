<?php

namespace App\Jobs\Revivers;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use Illuminate\Support\Facades\Mail;
use Eventjuicer\Repositories\ParticipantDeliveryRepository;
use Eventjuicer\Models\Participant;

class ParticipantInvite implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $participant, $eventId;

    public function __construct(Participant $participant, int $eventId)
    {
        $this->participant = $participant;
        $this->eventId = $eventId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ParticipantDeliveryRepository $deliveries)
    {
       
        if(! env("MAIL_TEST", true))
        {
              //  $repo->updateAfterSent($meetup->id);
         }
        if(Mail::send(new TicketDownloadReminder( $this->participant )))
        {
            $deliveries->updateAfterSend($this->participant->email, $this->eventId);
        }

       // Mail::send(new Bulk( $participant,   ) );
    }
}
