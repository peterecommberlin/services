<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;


class CallForPapersEmail extends Mailable
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
            $votes,
            $profile, 
            $voteUrl,
            $accountUrl;
    /*

        $this->participant, 
        $this->subject, 
        $this->view,
    
        $this->lang,
        $this->event_manager,
        $this->domain

    */

    public function __construct(Participant $participant, string $subject, string $view, int $votes)
    {
        $this->participant  = $participant;
        $this->subject      = $subject;
        $this->view         = $view;
        $this->votes        = $votes;
 
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
            config(["app.name" => "Targi eHandlu w Warszawie"]);
           
            $domain = "targiehandlu.pl";
            $cc = "prezentacje+auto@targiehandlu.pl";
            $emailPostfix = " - Targi eHandlu";

        }


        $admin_name = "Katarzyna Wicher";
        $admin_email = "prezentacje@targiehandlu.pl";
       
        $this->profile = new Personalizer( $this->participant, "");

        $this->voteUrl = "https://".$domain."/vote/" . $this->participant->id;
        
        $this->accountUrl = "https://admin.targiehandlu.pl/recall/" . $this->participant->token;

        $this->from($admin_email, $admin_name . $emailPostfix);

        $this->to( $this->participant->email );

        $this->cc( $cc ); 

        $this->subject($this->subject);

        return $this->markdown('emails.participants.' . $this->view);
    }
}
