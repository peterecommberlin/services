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

        $hash = (new Hashids())->encode($this->participant->id);


        // app()->setLocale("en");

        // config(["app.name" => "E-commerce Berlin Expo"]);

        // $this->url = "https://ecommerceberlin.com/ticket," . $hash;

        // $this->from("visitors@visitors.ecommerceberlin2019.com", "Lucas Zarna");

        // $this->subject("Your Ticket for E-commerce Belin Expo 2019");


        app()->setLocale("pl");

        config(["app.name" => "Targi eHandlu"]);

        $this->url = "https://targiehandlu.pl/ticket," . $hash;

        $this->from("zwiedzanie@targiehandlu.pl", "Jan Cyprych - Targi eHandlu");

        $this->subject("Bilet na środowe Targi eHandlu.");

        $this->to(trim(strtolower($this->participant->email)));


        // if(view()->exists("emails.visitor." . $this->view . "_text")) {
                
          
        // }

        $this->text('emails.visitor.tehkrk-ticket_text');

        return $this->markdown('emails.visitor.tehkrk-ticket');

    }
}
