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

    protected $participant, $lang = "pl", $event_manager;

    public  $errors, 
            $profile, 
            $profileUrl, 
            $accountUrl, 
            $exampleUrl;

    public $fieldNames = [

        "pl" => [


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

        ],
        
        "en" => [

            "about"             => "Company description",
            "countries"         => "Area of operations",
            "expo"              => "Special offer for visitors",
            "facebook"          => "Facebook profile URL",
            "keywords"          => "Industries / keywords",
            "linkedin"          => "Linkedin profile URL",
            "logotype"          => "URL to company logotype (.png, .gif, .jpg)",
            "name"              => "Company name",
            "opengraph_image"   => "Custom image when sharing to social portals",
            "products"          => "Key product/service",
            "twitter"           => "Twitter profile URL",
            "website"           => "Company website URL",
            "lang"              => "Language",
            "event_manager"     => "Email address to Event Manager (if differs)"
        ]
    ];

    public $translations = [

        "pl" => [

            "empty"     =>  "to pole jest puste lub jego zawartość wydaje się za krótka",
            "badformat" =>  "wartość w tym polu ma błędny format. sprawdź, proszę.",
            "nohtml"    => "treść możesz formatować używając HTML. dlaczego z tego nie skorzystać?"

        ],

        "en" => [

            "empty"    =>  "this field is empty or seems to be to short",
            "badformat" =>  "field value has bad format - please fix it",
            "nohtml"    => "this field accepts basic formatting - why not use it?"
        ]

    ];


    public $settings = [

        "pl" => [
            "subject" => "Profil Firmy na stronie Targów - wymagane działanie.",
            "accountUrl" => "https://account.targiehandlu.pl/#login?token=",
        ],
        "en" => [
            "subject" => "Exhibitor's public profile needs your attention. ...and action",
             "accountUrl" => "https://account.ecommercewarsaw.com/#login?token=",
        ]
    ];

    public function __construct(Participant $participant, array $errors, string $lang, string $event_manager)
    {
        $this->participant  = $participant;
        $this->errors       = $errors;
        $this->event_manager = $event_manager;

        if( $lang === "en" ){
            $this->lang = "en";
        }

    }


    protected function getSetting(string $name){

        return $this->settings[$this->lang][$name];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      

        $this->profile = new Personalizer( $this->participant, "");

        //////////

        $arr = [];

        foreach($this->errors as $fieldName => $problem)
        {

             $arr[ $this->fieldNames[$this->lang][$fieldName] ] = $this->translations[$this->lang][ $problem ];

        }

        $this->errors = $arr;

        $this->profileUrl = "https://targiehandlu.pl/" . 
                $this->participant->company->slug . 
                ",c,". 
                $this->participant->company_id;

        $this->accountUrl = $this->getSetting("accountUrl")  . $this->participant->token;

        $this->exampleUrl = "https://targiehandlu.pl/nazwa-firmy-company-name,c,1216";

        $this->to( trim(strtolower($this->participant->email)) );

        $this->cc( "targiehandlu+auto@targiehandlu.pl" ); 


        if(strpos($this->event_manager, "@")!==false && trim($this->event_manager)!== $this->participant->email){

            $this->cc( $this->event_manager ); 

        }

        $this->from("targiehandlu@targiehandlu.pl", "Adam Zygadlewicz, Targi eHandlu - Ecommerce Poland Expo");

        $this->subject( $this->getSetting("subject") );

        return $this->markdown('emails.company.badprofile2-' . $this->lang);
    }
}
