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
    
    public      $subject, 
                $view, 
                $p, 
                $siteUrl, 
                $ticketUrl, 
                $exhibitorsURl, 
                $presentersURl, 
                $scheduleURl, 
                $registerURl;

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



        // app()->setLocale("en");
        // config(["app.name" => "E-commerce Berlin Expo"]);


        $this->p = new Personalizer( $this->participant, "");

        $hash = (new Hashids())->encode($this->participant->id);


        $baseUrl = "https://targiehandlu.pl";
        $params  = "?utm_source=sprawny&utm_medium=email&utm_campaign=teh16partner";

        $this->ticketUrl = $baseUrl . "/ticket/" . $hash . $params;

        $this->siteUrl = $baseUrl . $params;

        $this->exhibitorsURl = $baseUrl . "/exhibitors" . $params;
        $this->presentersURl = $baseUrl . "/presenters" . $params;
        $this->scheduleURl = $baseUrl . "/schedule" . $params;
        $this->registerURl = $baseUrl . "/visit" . $params;


        $this->to( strtolower(trim($this->participant->email)) );

        $this->from("zwiedzanie@targiehandlu.pl", "Jan Cyprych - TEH");

        $this->subject($this->subject);

        if(view()->exists("emails.visitor." . $this->view . "_text")) {
                
            $this->text('emails.visitor.' . $this->view . "_text");

        }

        return $this->markdown('emails.visitor.' . $this->view);


    }
}
