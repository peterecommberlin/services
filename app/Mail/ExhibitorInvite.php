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
  //  public $image;

    public function __construct($participant, $subject)
    {
        $this->participant  = $participant;
        $this->subject      = $subject;

        //$this->image = $this->embed("asd");
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
