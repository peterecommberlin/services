<?php

namespace App\Mail\Meetups;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;

class Bulk extends Mailable
{
    use Queueable, SerializesModels;

    protected $participant;

    public $p, $url, $howmanyMeetups = 1;

    public function __construct(Participant $participant, $howmanyMeetups = 1)
    {
        $this->participant = $participant;
        $this->howmanyMeetups = $howmanyMeetups;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->p = new Personalizer( $this->participant, "") ;

        $this->url = "https://rsvp.ecommerceberlin.com/rsvp?token=" . $this->participant->token;

        $this->from("rsvp+visitor@ecommerceberlin.com", "E-commerce Berlin Expo");

        $this->to((string) $this->participant->email);

        $this->subject("New meetup invitations");

        return $this->markdown('emails.meetups.bulk');
    }
}
