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
    protected $not_provided = "nie podano";
    protected $domain = "targiehandlu.pl";
    protected $sender_email = "targiehandlu+rsvp@targiehandlu.pl";
    protected $sender_name = "Adam Zygadlewicz - Targi eHandlu";
    protected $subject = "Sukces! Potwierdzone spotkanie";
    protected $view = "approved_pl";

    public $p, $url, $recipient;

    public function __construct(Meetup $meetup)
    {
        $this->meetup = $meetup;
      
    }


    public function build()
    {

        if($this->meetup->group_id > 1){

            app()->setLocale("en");
            config(["app.name" => "E-commerce Berlin Expo"]);

            $this->domain = "ecommerceberlin.com";

            $this->sender_email = "rsvp@ecommerceberlin.com";
            $this->sender_name = "Charlene Pham - E-commerce Berlin Expo";
            $this->subject = "Invitation accepted! Contact details attached.";
            $this->view = "approved_en";

        }

        $this->p = new Personalizer( $this->meetup->participant, "", [

            "cname2"    => "-- ".$this->not_provided." --",
            "phone"     => "-- ".$this->not_provided." --",
            "position"  => "-- ".$this->not_provided." --"
        
        ] ) ;

        $this->url = "https://account.".$this->domain."/#/login?token=" . $this->meetup->admin->token;

        $this->recipient = (string) array_get($this->meetup->data, "from_email", "");

        if(filter_var($this->recipient, FILTER_VALIDATE_EMAIL)){
            $this->to($this->recipient);
        }else{
            $this->to($this->meetup->admin->email);
        }   

        $this->from($this->sender_email, $this->sender_name);

        if($this->recipient != $this->meetup->admin->email)
        {
            $this->cc($this->meetup->admin->email);
        }

        $this->replyto($this->meetup->participant->email);

        $this->subject($this->subject);

        return $this->markdown('emails.meetups.' . $this->view);
    }
}
