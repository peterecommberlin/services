<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;


class GeneralExhibitorEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $participant, $domain;

    public  $subject,
            $view,
            $lang,
            $event_manager,
            $profile, 
            $profileUrl, 
            $trackingLink,
            $accountUrl;


    public function __construct(Participant $participant, string $subject, string $view, string $lang, string $event_manager, string $domain)
    {
        $this->participant  = $participant;
        $this->view       = $view;
        $this->subject    = $subject;
        $this->event_manager = trim($event_manager);
        $this->domain       = $domain;
        $this->lang       = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if(strpos($this->domain, "ecommerceberlin") !== false){

            app()->setLocale("en");
            config(["app.name" => "E-commerce Berlin Expo"]);
        }


        $this->profile = new Personalizer( $this->participant, "");

        $this->profileUrl = "https://ecommerceberlin.com/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.ecommerceberlin.com/#/login?token=" . $this->participant->token;
       

        $this->trackingLink = $this->profileUrl . sprintf("?utm_source=th3rCMiM_%s&utm_medium=link&utm_campaign=teh15c&utm_content=raw", $this->participant->company_id);

        $this->to( trim(strtolower($this->participant->email)) );

        if($this->event_manager && filter_var($this->event_manager, FILTER_VALIDATE_EMAIL) ){
            $this->cc( $this->event_manager ); 
        }

        if($this->lang == "de"){

            $this->from("ecommerceberlin@ecommerceberlin.com", "Jan Sobczak - E-commerce Berlin Expo");
        }else{
             

             $this->from("ecommerceberlin@ecommerceberlin.com", "Aleksandra Miedzynska - E-commerce Berlin Expo");
        }

        $this->cc( "ecommerceberlin+auto@ecommerceberlin.com"); 

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view);
    }
}
