<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExhibitorInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $subject;
    public $imageEnc;
    public $promolink;

    public function __construct($participant, $imageEnc, $promolink, $subject)
    {
        $this->participant  = $participant;
        $this->imageEnc     = $imageEnc;
        $this->subject      = $subject;
        $this->promolink    = $promolink;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->subject)->markdown('emails.exhibitor-invite');
    }
}
