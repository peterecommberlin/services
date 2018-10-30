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

            "cname2"    => "-- nie podano --",
            "phone"     => "-- nie podano --",
            "position"  => "-- nie podano --"
        
        ] ) ;

        $this->url = "https://account.targiehandlu.pl/#/login?token=" . $this->meetup->admin->token;

        $this->recipient = (string) array_get($this->meetup->data, "from_email", "");


        $this->to($this->recipient);


        $this->from("targiehandlu+rsvp@targiehandlu.pl", "Adam Zygadlewicz - Targi eHandlu");

  
        if($this->recipient != $this->meetup->admin->email)
        {
            $this->cc($this->meetup->admin->email);
        }

        $this->replyto($this->meetup->participant->email);

        $this->subject("Sukces! Potwierdzone spotkanie");

        return $this->markdown('emails.meetups.approved_pl');
    }
}
