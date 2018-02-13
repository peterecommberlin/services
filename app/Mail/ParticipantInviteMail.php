<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;





use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Hashids;

class ParticipantInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $participant;
    public $p, $url;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $this->p = new Personalizer( $this->participant, "");

        $hash = (new Hashids())->encode($this->participant->id);

        $this->url = "https://ecommerceberlin.com/ticket/" . $hash;

        $this->to( strtolower(trim($this->participant->email)) );

        $this->from("visitors+re@ecommerceberlin.com", "E-commerce Berlin Expo");

        $this->subject("Instant ticket for E-commerce Berlin Expo? It's coming on Thursday!");

        return $this->markdown('emails.tickets.restore');


    }
}
