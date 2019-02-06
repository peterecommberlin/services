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

        if( $this->participant->group_id > 1 ){

            app()->setLocale("en");
            config(["app.name" => "E-commerce Berlin Expo"]);
        }


        $admin = $this->participant->company->admin;

        if($admin){
            $admin_name = $admin->fname . ' ' . $admin->lname;
            $admin_email = $admin->email;
        }
        else
        {
            $admin_name = "";
            $admin_email = "ecommerceberlin@ecommerceberlin.com";
        }

       


        $this->profile = new Personalizer( $this->participant, "");

        $this->profileUrl = "https://ecommerceberlin.com/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.ecommerceberlin.com/#/login?token=" . $this->participant->token;
       

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
