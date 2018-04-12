<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;


class PingWhenEmptyProfileEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $participant;

    public  $errors, 
            $profile, 
            $profileUrl, 
            $accountUrl, 
            $exampleUrl;

    public $fieldNames = [

        "about"             => "Opis firmy",
        "countries"         => "Zasięg działalności",
        "expo"              => "Oferta specjalna na Targi",
        "facebook"          => "Profil firmy na Facebook",
        "keywords"          => "Słowa kluczowe",
        "linkedin"          => "Profil firmy na LinkedIn",
        "logotype"          => "Adres URL do logotypu (.png, .gif, .jpg)",
        "name"              => "Nazwa firmy",
        "opengraph_image"   => "Obrazek udostępniany na serwisach społecznościowych",
        "products"          => "Kluczowe produkty / usługi",
        "twitter"           => "Profil firmy na Twitter",
        "website"           => "Adres URL strony firmowej",
        "lang"              => "Język kontaktu",
        "event_manager"     => "Osoba do kontaktu w tematach logistycznych"

    ];

    public $translations = [

        "empty"     =>  "to pole jest puste lub jego zawartość wydaje się za krótka",
        "badformat" =>  "wartość w tym polu ma błędny format. sprawdź, proszę.",
        "nohtml"    => "treść możesz formatować używając HTML. dlaczego z tego nie skorzystać?"
        
    ];

    public function __construct(Participant $participant, array $errors)
    {
        $this->participant  = $participant;

        $this->errors       = $errors;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->profile = new Personalizer( $this->participant, "");

        $arr = [];

        foreach($this->errors as $fieldName => $problem)
        {
            $arr[ $this->fieldNames[$fieldName] ] = $this->translations[ $problem ];
        }

        $this->errors = $arr;

        $this->profileUrl = "https://targiehandlu.pl/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;

        $this->accountUrl = "https://account.targiehandlu.pl/#login?token=" . $this->participant->token;
        $this->exampleUrl = "https://targiehandlu.pl/nazwa-firmy-company-name,c,1216";

        $this->to( trim(strtolower($this->participant->email)) );

        $this->cc( "targiehandlu+auto@targiehandlu.pl" ); 

        $this->from("targiehandlu@targiehandlu.pl", "Bartek Meller, Targi eHandlu");

        $this->subject("BARDZO proszę popraw profil Wystawcy.");

        return $this->markdown('emails.company.badprofile');
    }
}
