<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use Eventjuicer\Models\Participant;
use Eventjuicer\Services\Personalizer;
use Eventjuicer\Services\Exhibitors\Email;
use Eventjuicer\Services\Exhibitors\CompanyData;

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
            $viewlang,
            $event_manager,
            $stats,
            $representatives,
            $prizes,
            $translations,
            $creatives,
            $profile, 
            $profileUrl, 
            $company,
            $accountUrl,
            $trackingLink,
            $pollUrl,
            $footer;
 

    public $sharers, $newsletter, $assignedPrizes;

    public $calendar;

    public function __construct(Participant $participant, array $config)
    {
        $this->participant  = $participant;
        $this->domain = array_get($config, "domain");

        $this->subject = array_get($config, "subject", "");
        $this->view = array_get($config, "email");
        $this->lang = array_get($config, "lang");
        $this->viewlang = array_get($config, "viewlang");
        $this->event_manager = array_get($config, "event_manager", "");
        $this->stats = array_get($config, "stats", []);
        $this->representatives = array_get($config, "representatives", []);
        $this->prizes = array_get($config, "prizes", []);
        $this->translations = array_get($config, "translations", []);
        $this->creatives = array_get($config, "creatives", []);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $companydata = new CompanyData($this->participant);

        $emailHelper = new Email($this->participant);

        $this->footer = $emailHelper->getFooter();
        $this->calendar = $emailHelper->getCalendarUrl();
        $this->pollUrl = $emailHelper->getPollUrl();


        

        //this should be moved to settings?...
       if( $this->participant->group_id > 1 ){

            $from = "ecommerceberlin@ecommerceberlin.com";
            $eventName = "E-commerce Berlin Expo";
            $domain = "ecommerceberlin.com";
            $cc = "ecommerceberlin+auto@ecommerceberlin.com";

            app()->setLocale("en");
            config(["app.name" => $eventName]);

        }else{


            $from = "targiehandlu@targiehandlu.pl";
            $eventName = "Targi eHandlu";
            $domain = "targiehandlu.pl";
            $cc = "targiehandlu+auto@targiehandlu.pl";

            if($this->viewlang === "en"){
                app()->setLocale("en");
                config(["app.name" => "E-commerce Warsaw Expo"]);
            }
            else
            {
                app()->setLocale("pl");
                config(["app.name" => $eventName]);
            }
            
        }

        $this->profile = $companydata->profileData();
        $this->company = $companydata->companyData();

        //URLS....
        $this->profileUrl = $companydata->profileUrl();
        $this->accountUrl = $companydata->accountUrl();
        $this->trackingLink = $companydata->trackedProfileUrl();

        if(!empty($this->creatives)){
            
            $englishCreatives = collect($this->creatives)->where("lang", "en");
            $this->sharers = $englishCreatives->where("name","logotype")->pluck("sharers")->collapse()->all();
            $this->newsletter = array_get($englishCreatives->where("name", "invite")->first(), "newsletter");

            $assignedPrizes = 1;

        }

        $recipient =  trim( strtolower( $this->participant->email ));

        if($this->event_manager && $recipient !== $this->event_manager){

            $this->to( $this->event_manager );
            $this->cc( $recipient );
        }
        else{

            $this->to( $recipient );

        }

        $this->from($from, $emailHelper->getSender() . " - " . $eventName);

        $this->cc( $cc ); 

        $this->subject($this->subject);

        return $this->markdown('emails.company.' . $this->view);
    }
}
