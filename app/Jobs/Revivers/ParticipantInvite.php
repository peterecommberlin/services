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
use App\Mail\ParticipantInviteMail as EmailConfig;
use Eventjuicer\Services\Revivers\ParticipantSendable;


class ParticipantInvite //implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $participant, $eventId, $view, $subject;

    public function __construct(Participant $participant, int $eventId, array $config)
    {
        $this->participant = $participant;
        $this->eventId = $eventId;
        $this->view = array_get($config, "view");
        $this->subject = array_get($config, "subject");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ParticipantDeliveryRepository $deliveries, ParticipantSendable $sendable)
    {


        // double check !

        if(! $sendable->filter( collect([])->push( $this->participant ), $this->eventId)->count() )
        {
            return;
        }


        Mail::send(new EmailConfig( 
            $this->participant, 
            $this->view, 
            $this->subject )
        );

       
        if(! env("MAIL_TEST", true) )
        {
             $deliveries->updateAfterSend($this->participant->email, $this->eventId);
        }
     
    }
}
