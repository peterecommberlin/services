<?php

namespace App\Mail\Meetups;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;

class Bulk extends Mailable {

    use Queueable, SerializesModels;

    protected $sender_email     = "zwiedzanie+rsvp@targiehandlu.pl";
    protected $sender_name      = "Katarzyna Wicher";
    protected $domain           = "targiehandlu.pl";
    
    public    $subject          = "Targi eHandlu #17 - oto Wystawcy, którzy chcą się z Tobą spotkać";
    public $view             = "bulk_pl";
    
    protected $participant;

    public $p;
    public $url;
    public $howmanyMeetups = 1;

    public function __construct(Participant $participant, $howmanyMeetups = 1){

        $this->participant = $participant;
        $this->howmanyMeetups = $howmanyMeetups;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if($this->participant->group_id > 1){

            app()->setLocale("en");
            config(["app.name" => "E-commerce Berlin Expo"]);

            $this->domain = "ecommerceberlin.com";
            $this->sender_email = "rsvp@ecommerceberlin.com";
            $this->sender_name = "Charlene Pham - E-commerce Berlin Expo";
            $this->subject = "Exhibitors that want to meet you. Your action needed.";
            $this->view = "bulk_en";
        }

        $this->p = new Personalizer( $this->participant, "");

        $this->url = "https://rsvp.".$this->domain."/rsvp?token=" . $this->participant->token;

        $this->from($this->sender_email, $this->sender_name);

        $this->to((string) $this->participant->email);

        $this->subject($this->subject);

        return $this->markdown('emails.meetups.' . $this->view);
    }
}
