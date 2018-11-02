<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;





use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Hashids;

class GeneralReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $participant, $email, $subject;
    public $p, $url;

    public function __construct(Participant $participant, array $config)
    {
        $this->participant = $participant;
        $this->email = !empty($config["email"]) ? $config["email"] : "";
        $this->subject = !empty($config["subject"]) ? $config["subject"] : "";

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

        $this->subject("Twój bilet na Targi");

        return $this->markdown('emails.tickets.reminder3');


    }
}
