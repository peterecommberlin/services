<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;


class PingWhenEmptyProfileEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $participant;
    public $errors, $profile;

    public $translations = [

        
    ];

    public function __construct(Participant $participant, array $errors)
    {
        $this->participant  = $participant;
        $this->errors       = $errors;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->profile = new Personalizer( $this->participant, "");

        $this->url = "https://account.targiehandlu.pl/#login?token=" . $this->participant->token;

        $this->to( trim(strtolower($this->participant->email)) );

        $this->from("targiehandlu@targiehandlu.pl", "Bartek Meller, Targi eHandlu");

        $this->subject("Proszę uzupełnij profil firmy :) [automated message]");

        return $this->markdown('emails.company.badprofile');
    }
}
