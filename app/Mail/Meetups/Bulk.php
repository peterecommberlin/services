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

        $this->url = "https://rsvp.targiehandlu.pl/rsvp?token=" . $this->participant->token;

        $this->from("zwiedzanie+rsvp@targiehandlu.pl", "Jan Selga, XV Targi eHandlu w Warszawie");

        $this->to((string) $this->participant->email);

        $this->subject("Oto Wystawcy, którzy chcą się z Tobą spotkać");

        return $this->markdown('emails.meetups.bulk_pl');
    }
}
