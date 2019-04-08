<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;




use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;


class CompanyRepresentativesEmail extends Mailable
{


    use Queueable, SerializesModels;

    protected $participant, $event_manager, $viewlang;

    public  $representatives,
            $profile, 
            $accountUrl,
            $view,
            $subject;


    public function __construct(
        Participant $participant, 
        Collection $representatives,
        array $config){

        $this->participant  = $participant;
        $this->representatives = $representatives;
       

        $this->view = array_get($config, "view");
        $this->event_manager = array_get($config, "event_manager");
        $this->viewlang = array_get($config, "viewlang", "en");
        $this->subject = array_get($config, "subject");


    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $admin = $this->participant->company->admin;


        if( $this->participant->group_id > 1 ){

            $eventName = "E-commerce Berlin Expo";
            $domain = "ecommerceberlin.com";

            app()->setLocale("en");
            config(["app.name" => $eventName]);
           
            $cc = "ecommerceberlin+auto@ecommerceberlin.com";

        }else{


            $admin_name = "";
            $admin_email = "targiehandlu@targiehandlu.pl";
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


        if($admin){
            $admin_name = $admin->fname . ' ' . $admin->lname;
            $admin_email = $admin->email;
        }


        $this->profile = new Personalizer( $this->participant, "");


        $this->profileUrl = "https://" . $domain . "/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.".$domain."/#/login?token=" . $this->participant->token;
       

        if($this->event_manager && $this->participant->email !== $this->event_manager){

            $this->to( $this->event_manager );
            $this->cc( $this->participant->email ); 
        }
        else{

            $this->to( trim(strtolower($this->participant->email)) );

        }

        $this->from($admin_email, $admin_name . " - " . $eventName);

        $this->cc( $cc ); 

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view . "-" . $this->viewlang);
    }


}
