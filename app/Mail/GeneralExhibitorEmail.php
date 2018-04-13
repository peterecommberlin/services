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

    public  $profile, 
            $profileUrl, 
            $trackingLink,
            $accountUrl;


    public function __construct(Participant $participant, string $subject, string $view)
    {
        $this->participant  = $participant;
        $this->view       = $view;
        $this->subject    = $subject;

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
       
        $this->trackingLink = $this->profileUrl . sprintf("?utm_source=company_%s&utm_medium=link&utm_campaign=teh14c&utm_content=raw", $this->participant->company_id);

        $this->to( trim(strtolower($this->participant->email)) );

        $this->cc( "targiehandlu+auto@targiehandlu.pl" ); 

        $this->from("targiehandlu@targiehandlu.pl", "Bartek Meller, Targi eHandlu");

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view);
    }
}
