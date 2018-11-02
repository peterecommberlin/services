<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use Eventjuicer\Models\Participant;
use Eventjuicer\Repositories\ParticipantDeliveryRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralReminder as Email;
use Eventjuicer\Services\Revivers\ParticipantSendable;


class SendGeneralReminder// implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $participant, $eventId, $config;

    public function __construct(Participant $participant, int $eventId, array $config)
    {
        $this->participant = $participant;
        $this->eventId = $eventId;
        $this->config = $config;
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


        Mail::send(new Email( 
            $this->participant, 
            $this->config 
        ));


        if(! env("MAIL_TEST", true))
        {
            $deliveries->updateAfterSend($this->participant->email, $this->eventId);
        }


       
    }
}




