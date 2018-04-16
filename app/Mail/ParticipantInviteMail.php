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
    public $subject, $view, $p, $siteUrl, $ticketUrl;

    public function __construct(Participant $participant, string $view, string $subject)
    {
        $this->participant = $participant;
        $this->view = $view;
        $this->subject = $subject;
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

        $this->siteUrl = "https://targiehandlu.pl";

        $this->ticketUrl = $this->siteUrl . "/ticket/" . $hash;

        $this->to( strtolower(trim($this->participant->email)) );

        $this->from("zwiedzanie@targiehandlu.pl", "Roman Turaj, Targi eHandlu");

        $this->subject($this->subject);

        return $this->markdown('emails.visitor.' . $this->view);


    }
}
