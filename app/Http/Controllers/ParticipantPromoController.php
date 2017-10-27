<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use Eventjuicer\Repositories\ParticipantRepository;


class ParticipantPromoController extends Controller
{
    protected $repo;

	protected $partner;

	protected $promolink;


     function __construct(Request $request, ParticipantRepository $repo)
    {
    	$this->repo = $repo;

    	$partner_id = $request->route("id");

    	$this->partner = $this->repo->toSearchArray($partner_id);

    	$this->partnerName = array_get($this->partner, "fields.cname2",
    							array_get($this->partner, "fields.cname")
    						);

    	$this->promolink = "https://targiehandlu.pl/?utm_source=partner_".$partner_id."&utm_medium=".str_slug($this->partnerName)."&utm_campaign=visitors_TEH13";

    	View::share("partner_id", $partner_id);
    	View::share("partner", $this->partner);
    	
		View::share("partnerName", $this->partnerName);

    	View::share("promolink", $this->promolink);
    }

    function index($id)
    {
    	

    	return view("participant.promo", []);
    }

    function newsletter($id)
    {
    	$data = ["iframeSrc" => action("NewsletterController@index", ["id"=>$id])];

    	return view("participant.newsletter", $data);
    }

 	function ranking($id)
    {
    	
    	return view("participant.ranking", []);
    }

    function tutorial($id)
    {
    	
    	return view("participant.tutorial", []);
    }


}
