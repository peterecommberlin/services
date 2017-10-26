<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ExhibitorInvite;

use Eventjuicer\Repositories\ParticipantRepository;

class NewsletterController extends Controller
{
    function __construct()
    {

    }

    function index(ParticipantRepository $participant, $id)
    {
    	$p = $participant->toSearchArray($id);

    //	dd($p);
    	return new ExhibitorInvite($p, "zaproszenie na targi");
    }
}
