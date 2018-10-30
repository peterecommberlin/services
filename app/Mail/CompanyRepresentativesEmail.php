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

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $participant, $lang = "pl", $event_manager;

    public  $representatives,
            $profile, 
            $accountUrl;


    public function __construct(
        Participant $participant, 
        Collection $representatives,
        string $lang, 
        string $event_manager
    ){
        $this->participant  = $participant;
        $this->representatives = $representatives;
        $this->event_manager = $event_manager;

        if( $lang === "en" ){
            $this->lang = "en";
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $this->profile = new Personalizer( $this->participant, "");


        $this->accountUrl = "https://account.targiehandlu.pl/#login?token=" . $this->participant->token;
       
        if($this->lang == "en"){

            $this->accountUrl = "https://account.ecommercewarsaw.com/#login?token=" . $this->participant->token;
        }


        $this->to( trim(strtolower($this->participant->email)) );

        $this->cc( "targiehandlu+auto@targiehandlu.pl" ); 


        if(strpos($this->event_manager, "@")!==false && trim($this->event_manager)!== $this->participant->email){

            $this->cc( $this->event_manager ); 

        }

        $this->from("targiehandlu@targiehandlu.pl", "Adam Zygadlewicz - Targi eHandlu / Ecommerce Poland Expo");


        if($this->lang == "en"){

            $this->subject( "Last call: add/modify exhibitor representatives!" );
        
        }else{
            
            $this->subject( "Ostatnia szansa: dodaj/edytuj przedstawicieli Wystawcy..." );
        }

        

        return $this->markdown('emails.company.representatives-list-' . $this->lang);
    }
}
