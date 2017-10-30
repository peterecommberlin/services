<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Eventjuicer\Services\ParticipantPromo;
use Eventjuicer\Services\ParticipantPromoCreatives;

class PromoController extends Controller
{

    protected $promo, $creatives;


    function __construct(ParticipantPromo $promo, ParticipantPromoCreatives $creatives)
    {

        $this->promo = $promo;

        $this->creatives = $creatives;  

    }

    function index($id)
    {
        $this->creatives->autogenerateIfNone("link");

        $creative = $this->creatives->filtered("link")->first();

    	$link = $this->creatives->buildLink($creative->id);

    	return view("promo.start", compact("link"));
    }



 	function ranking($id)
    {
    	
    	return view("promo.ranking", []);
    }

    function logistics($id)
    {
    	
    	return view("promo.logistics", []);
    }


    function learn($id)
    {
        
        return view("promo.learn", []);
    }



  

}
