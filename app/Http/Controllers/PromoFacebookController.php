<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Eventjuicer\Services\DetectCrawlers;
use Eventjuicer\Services\ParticipantPromo;
use Eventjuicer\Services\ParticipantPromoCreatives;

use Jaybizzle\CrawlerDetect\CrawlerDetect;

class PromoFacebookController extends Controller
{

	protected $promo, $creatives;


	function __construct(ParticipantPromo $promo, ParticipantPromoCreatives $creatives)
	{
        $this->promo = $promo;	

        $this->creatives = $creatives;
	}

    function preview(Request $request, $hash)
    {


        $og = $this->creatives->openGraph();

        return view("promo.opengraph", [

                "title"         => array_get($og, "title"),
                "description"   => array_get($og, "description"),
                "image"         => array_get($og, "image"),
        ]);

    }


    function index(Request $request, CrawlerDetect $detector, $hash)
    {

        if(!$this->promo->isValid())
        {
             abort(404);
        }

        $og = $this->creatives->openGraph();

        if(! $og)
        {
            //fallback???

             abort(404);
        }



        if($detector->isCrawler())
        {

             return view("promo.opengraph", [

                "title"         => array_get($og, "title"),
                "description"   => array_get($og, "description"),
                "image"         => array_get($og, "image"),
            
            ]);
        }
        else
        {
            return redirect($this->creatives->targetUrl());

               
        }
	
    }
}
