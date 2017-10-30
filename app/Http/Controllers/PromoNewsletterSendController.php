<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;



use Eventjuicer\Services\ParticipantPromo;
use Eventjuicer\Services\ParticipantPromoCreatives;

class PromoNewsletterSendController extends Controller
{

    protected $promo, $creatives;

    function __construct(ParticipantPromo $promo, ParticipantPromoCreatives $creatives)
    {

        $this->promo = $promo;

        $this->creatives = $creatives;

    }

   

    function index($participantId)
    {


        $newsletters = $this->creatives->filtered("newsletter");

        if(!$newsletters->count())
        {
            
            return redirect()->action("PromoNewsletterController@index", 

            compact("participantId"))->with("status", "Hola hola... by wysyłać trzeba utworzyć!");

        }




    	$data = [

    		
    	];

    	return view("promo.newsletter.send", $data);
    }



   

}
