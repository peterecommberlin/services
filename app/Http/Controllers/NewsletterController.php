<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Mail\ExhibitorInvite;
use Eventjuicer\Repositories\ParticipantRepository;


use Eventjuicer\Services\ImageEncode;

class NewsletterController extends Controller
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


    function index()
    {

		$img = array_get($this->partner, "fields.logotype", 
					array_get($this->partner, "fields.avatar")
			   );

		$imageEnc = new ImageEncode($img);

    	
    	return new ExhibitorInvite(
    		$this->partner, 
    		$imageEnc, 
    		$this->promolink,
    		"Spotkajmy się 8 listopada w Warszawie!");
    }

    function download()
    {	
    	return response()->downloadViewAsHtml( $this->index() );
    }
}
