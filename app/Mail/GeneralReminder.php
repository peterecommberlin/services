<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;





use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Hashids;

class GeneralReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $participant, $email;
    
    public $p, 
    $ticketUrl, 
    $siteUrl, 
    $exhibitorsURl,
    $presentersURl,
    $scheduleURl,
    $registerURl,
    $url, $subject;

    public function __construct(Participant $participant, array $config)
    {
        $this->participant = $participant;
        $this->email = !empty($config["email"]) ? $config["email"] : "";
        $this->subject = !empty($config["subject"]) ? $config["subject"] : "";

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        app()->setLocale("pl");
        config(["app.name" => "Targi eHandlu"]);

        $this->p = new Personalizer( $this->participant, "");

        $hash = (new Hashids())->encode($this->participant->id);


        $baseUrl = "https://targiehandlu.pl";
        $params  = "";

        $this->ticketUrl = $baseUrl . "/ticket/" . $hash . $params;

        $this->siteUrl = $baseUrl . $params;

        $this->exhibitorsURl = $baseUrl . "/exhibitors" . $params;
        $this->presentersURl = $baseUrl . "/presenters" . $params;
        $this->scheduleURl = $baseUrl . "/schedule" . $params;
        $this->registerURl = $baseUrl . "/visit" . $params;
        $this->url = $this->ticketUrl;


        $this->to(trim(strtolower($this->participant->email)));

        $this->from("zwiedzanie@targiehandlu.pl", "Katarzyna Wicher - Targi eHandlu");

      //  $this->subject("Your ticket is ready! Download and print!");

        $this->subject($this->subject);

        if(view()->exists("emails.visitor." . $this->email . "_text")) {
                
            $this->text('emails.visitor.' . $this->email . "_text");

        }

        return $this->markdown('emails.visitor.' . $this->email);


    }
}
