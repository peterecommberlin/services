<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;





use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Hashids;

class TicketDownloadReminder extends Mailable
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

        $this->url = "https://targiehandlu.pl/ticket," . $hash;

        $this->to(trim(strtolower($this->participant->email)));

        $this->from("zwiedzanie@targiehandlu.pl", "Adam Zygadlewicz - Targi eHandlu");

      //  $this->subject("Your ticket is ready! Download and print!");

        $this->subject("Twój bilet na środowe Targi eHandlu jest gotowy!");

        return $this->markdown('emails.visitor.teh15-ticket-reminder');

    }
}
