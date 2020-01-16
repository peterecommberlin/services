<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Exhibitors\Email;

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
            $accountUrl,
            $footer;
    /*

        $this->participant, 
        $this->subject, 
        $this->view,
    
        $this->lang,
        $this->event_manager,
        $this->domain

    */

    public function __construct(Participant $participant, string $subject, string $view, string $lang, string $event_manager)
    {
        $this->participant  = $participant;
        $this->view         = $view;
        $this->subject      = $subject;
        $this->event_manager = trim($event_manager);
        $this->lang       = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $emailHelper = new Email($this->participant);

        $this->footer = $emailHelper->getFooter();


       if( $this->participant->group_id > 1 ){

            $from = "ecommerceberlin@ecommerceberlin.com";
            $eventName = "E-commerce Berlin Expo";
            $domain = "ecommerceberlin.com";
            $cc = "ecommerceberlin+auto@ecommerceberlin.com";

            app()->setLocale("en");
            config(["app.name" => $eventName]);

        }else{


            $from = "targiehandlu@targiehandlu.pl";
            $eventName = "Targi eHandlu";
            $domain = "targiehandlu.pl";
            $cc = "targiehandlu+auto@targiehandlu.pl";

            if($this->viewlang === "en"){
                app()->setLocale("en");
                config(["app.name" => "E-commerce Cracow Expo"]);
            }
            else
            {
                app()->setLocale("pl");
                config(["app.name" => $eventName]);
            }
            
        }


       


        $this->profile = new Personalizer( $this->participant, "");

        $this->profileUrl = "https://".$domain."/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.".$domain."/#/login?token=" . $this->participant->token;
       
        //EBE5
        $this->trackingLink = $this->profileUrl . sprintf("?utm_source=th4x90iy_%s&utm_medium=link&utm_campaign=promoninja&utm_content=raw", $this->participant->company_id);


        if($this->event_manager && $this->participant->email !== $this->event_manager){

            $this->to( $this->event_manager );
            $this->cc( $this->participant->email );
        }
        else{

            $this->to( trim( strtolower($this->participant->email)) );

        }

        $this->from($from, $emailHelper->getSender() . " - " . $eventName);

        $this->cc( $cc ); 

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view);
    }
}
