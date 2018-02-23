<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;





use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Hashids;

class Ankieta extends Mailable
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

        $this->url = "https://ecommerceberlin.com/recall/" . $this->participant->token;

        $this->to(trim(strtolower($this->participant->email)));

        $this->from("visitors@ecommerceberlin.com", "Lucas Zarna, E-commerce Berlin Expo");

        $this->subject("Was it good for you? Check photos!");

        return $this->markdown('emails.tickets.ankieta');


    }
}


 