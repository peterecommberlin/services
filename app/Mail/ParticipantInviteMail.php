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
                $registerURl,
                $offersUrl,
                $unsubscribe;

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

        if($this->participant->organizer_id > 1){
             $this->from("visitors@ecommerceberlin.com", "Lucas Zarna - E-commerce Berlin");
            $baseUrl = "https://ecommerceberlin.com";
            app()->setLocale("en");
            config(["app.name" => "E-commerce Berlin Expo"]);

        }else{

             $this->from("zwiedzanie@targiehandlu.pl", "Katarzyna Wołyńska - Targi eHandlu");
             $baseUrl = "https://targiehandlu.pl";
             config(["app.name" => "Targi eHandlu w Krakowie 22.04.2020"]);
             
        }

        $this->p = new Personalizer( $this->participant, "");

        $hash = (new Hashids())->encode($this->participant->id);

    //    $params  = "?utm_source=marketer&utm_medium=email&utm_campaign=teh17partner";
        $params = "";

        $this->ticketUrl = $baseUrl . "/ticket/" . $hash . $params;

        $this->siteUrl = $baseUrl . $params;

        $this->exhibitorsURl = $baseUrl . "/exhibitors" . $params;
        $this->presentersURl = $baseUrl . "/presenters" . $params;
        $this->scheduleURl = $baseUrl . "/schedule" . $params;
        $this->registerURl = $baseUrl . "/visit" . $params;
        $this->offersUrl = $baseUrl . "/offers" . $params;

        $this->unsubscribe = "https://services.eventjuicer.com/unsubscribe/" . $hash; 

        $this->to( strtolower(trim($this->participant->email)) );

        $this->subject($this->subject);

        if(view()->exists("emails.visitor." . $this->view . "_text")) {
                
            $this->text('emails.visitor.' . $this->view . "_text");

        }

        return $this->markdown('emails.visitor.' . $this->view);


    }
}
