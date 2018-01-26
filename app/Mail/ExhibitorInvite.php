<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Eventjuicer\Services\Personalizer;

class ExhibitorInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $fields;
    public $subject;
    public $imageEnc;
    public $promolink;
    public $body;

    public function __construct($participant, $imageEnc, $promolink, $subject, $body)
    {
        $this->participant  = $participant;
        $this->imageEnc     = $imageEnc;
        $this->subject      = $subject;
        $this->promolink    = $promolink;
        $this->body         = $body;

        $this->fields = new Personalizer($this->participant);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->subject)->markdown($this->body);
    }
}
