<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;





use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Hashids;

class TicketDownloadReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $participant;
    public $p, $url, $view;

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

        $hash = (new Hashids())->encode($this->participant->id);

        if($this->participant->organizer_id > 1){
            
            app()->setLocale("en");

            config(["app.name" => "E-commerce Berlin Expo"]);

            $this->url = "https://ecommerceberlin.com/ticket," . $hash;

            $this->from("visitors@ecommerceberlin.com", "Lucas Zarna - E-commerce Berlin Expo");

            $this->subject("Your PDF Ticket for E-commerce Belin Expo 2020");

            $this->view = "ebe5-ticket-reminder";

        }
        else
        {
        
            app()->setLocale("pl");

            config(["app.name" => "Targi eHandlu"]);

            $this->url = "https://targiehandlu.pl/ticket," . $hash;

            $this->from("zwiedzanie@targiehandlu.pl", "Katarzyna Wicher - Targi eHandlu");

            $this->subject("Mam Twój bilet na wtorkowe Targi eHandlu w Warszawie.");

            $this->view = "teh17-ticket";

        }
       
        $this->to(trim(strtolower($this->participant->email)));

        if(view()->exists("emails.visitor." . $this->view . "_text")) {
            $this->text('emails.visitor.' . $this->view . '_text');      
        }

        return $this->markdown('emails.visitor.' . $this->view);

    }
}
