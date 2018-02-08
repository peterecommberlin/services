<?php

namespace App\Mail\Meetups;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



use Eventjuicer\Models\Meetup;
use Eventjuicer\Services\Personalizer;


class Approved extends Mailable
{
    use Queueable, SerializesModels;

    protected $meetup;

    public $p, $url, $recipient;

    public function __construct(Meetup $meetup)
    {
        $this->meetup = $meetup;
      
    }


    public function build()
    {

        $this->p = new Personalizer( $this->meetup->participant, "", [

            "cname2"    => "not specified",
            "phone"     => "not specified",
            "position"  => "not specified"
        
        ] ) ;

        $this->url = "https://expojuicer.com/#/login?token=" . $this->meetup->admin->token;

        $this->recipient = (string) array_get($this->meetup->data, "from_email", "");


        $this->to($this->recipient);


        $this->from("rsvp+exhibitor@ecommerceberlin.com", "E-commerce Berlin Expo");

  
        if($this->recipient != $this->meetup->admin->email)
        {
            $this->cc($this->meetup->admin->email);
        }

        $this->replyto($this->meetup->participant->email);

        $this->subject("Success! Meeting request approved!");

        return $this->markdown('emails.meetups.approved');
    }
}
