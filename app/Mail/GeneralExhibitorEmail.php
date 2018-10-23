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

    protected $participant;

    public  $subject,
            $view,
            $lang,
            $event_manager,
            $profile, 
            $profileUrl, 
            $trackingLink,
            $accountUrl;


    public function __construct(Participant $participant, string $subject, string $view, string $lang, string $event_manager)
    {
        $this->participant  = $participant;
        $this->view       = $view;
        $this->subject    = $subject;
        $this->event_manager = trim($event_manager);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->profile = new Personalizer( $this->participant, "");

        $this->profileUrl = "https://targiehandlu.pl/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;


        $this->accountUrl = "https://account.targiehandlu.pl/#login?token=" . $this->participant->token;
       
        if($this->lang == "en"){

            $this->accountUrl = "https://account.ecommercewarsaw.com/#login?token=" . $this->participant->token;
        }

        $this->trackingLink = $this->profileUrl . sprintf("?utm_source=th3rCMiM_%s&utm_medium=link&utm_campaign=teh15c&utm_content=raw", $this->participant->company_id);

        $this->to( trim(strtolower($this->participant->email)) );

        if($this->event_manager && filter_var($this->event_manager, FILTER_VALIDATE_EMAIL) ){
            $this->cc( $this->event_manager ); 
        }

        $this->cc( "targiehandlu+auto@targiehandlu.pl" ); 

        $this->from("targiehandlu@targiehandlu.pl", "Adam Zygadlewicz, Targi eHandlu - Ecommerce Poland Expo");

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view);
    }
}
