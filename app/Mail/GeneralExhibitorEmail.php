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

        if($this->participant->group_id > 1){
            app()->setLocale("en");
            config(["app.name" => "E-commerce Berlin Expo"]);
            $domain = "ecommerceberlin.com";
            $cc = "ecommerceberlin+auto@ecommerceberlin.com";
            $emailPostfix = " - E-commerce Berlin";
        }
        else
        {
            app()->setLocale("pl");
            config(["app.name" => "Targi eHandlu w Krakowie"]);
           
            $domain = "targiehandlu.pl";
            $cc = "targiehandlu+auto@targiehandlu.pl";
            
            if($this->lang == "pl"){
                $emailPostfix = " - Targi eHandlu";
            }else{
                $emailPostfix = " - E-commerce Cracow Expo";
                config(["app.name" => "E-commerce Cracow Expo"]);
            }
        }

        $admin = $this->participant->company->admin;

        if($admin){
            $admin_name = $admin->fname . ' ' . $admin->lname;
            $admin_email = $admin->email;
        }
        else
        {
            $admin_name = "";
            $admin_email = "targiehandlu@targiehandlu.pl";
        }

       


        $this->profile = new Personalizer( $this->participant, "");

        $this->profileUrl = "https://".$domain."/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.".$domain."/#/login?token=" . $this->participant->token;
       

        // $this->trackingLink = $this->profileUrl . sprintf("?utm_source=th3rCMiM_%s&utm_medium=link&utm_campaign=promoninja&utm_content=raw", $this->participant->company_id);


         $this->trackingLink = $this->profileUrl . sprintf("?utm_source=th4wOPiy_%s&utm_medium=link&utm_campaign=promoninja&utm_content=raw", $this->participant->company_id);


        if($this->event_manager && $this->participant->email !== $this->event_manager){

            $this->to( $this->event_manager );
            $this->cc( $this->participant->email );
        }
        else{

            $this->to( trim( strtolower($this->participant->email)) );

        }

        $this->from($admin_email, $admin_name . $emailPostfix);

        $this->cc( $cc ); 

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view);
    }
}
