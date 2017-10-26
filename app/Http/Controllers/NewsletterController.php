<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ExhibitorInvite;

use Eventjuicer\Repositories\ParticipantRepository;

class NewsletterController extends Controller
{

	protected $repo;

    function __construct(ParticipantRepository $repo)
    {
    	$this->repo = $repo;
    }

    function index($id)
    {
    	$p = $this->repo->toSearchArray($id);

    	return new ExhibitorInvite($p, "zaproszenie na targi");
    }

    function download($id)
    {	

    	return response()->downloadViewAsHtml( $this->index($id) );
    }
}
