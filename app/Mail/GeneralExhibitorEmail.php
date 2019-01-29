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


    public function __construct(Participant $participant, string $subject, string $view, string $viewlang, string $lang, string $event_manager, string $domain)
    {
        $this->participant  = $participant;
        $this->view         = $view;
        $this->viewlang     = $viewlang;
        $this->subject      = $subject;
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


        $admin = $this->participant->company->admin;

        $admin_name = $admin->fname . ' ' . $admin->lname;
        $admin_email = $admin->email;


        $this->profile = new Personalizer( $this->participant, "");

        $this->profileUrl = "https://ecommerceberlin.com/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.ecommerceberlin.com/#/login?token=" . $this->participant->token;
       

        $this->trackingLink = $this->profileUrl . sprintf("?utm_source=th3rCMiM_%s&utm_medium=link&utm_campaign=promoninja&utm_content=raw", $this->participant->company_id);


        if($this->event_manager && $this->participant->email !== $this->event_manager){

            $this->to( $this->event_manager );
        }
        else{

            $this->to( trim(strtolower($this->participant->email)) );

        }

        $this->from($admin_email, $admin_name . " - E-commerce Berlin Expo");

        $this->cc( "ecommerceberlin+auto@ecommerceberlin.com"); 

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view . "-" . $this->viewlang);
    }
}
