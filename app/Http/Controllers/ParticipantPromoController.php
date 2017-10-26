<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantPromoController extends Controller
{
    function __construct()
    {

    }


    function index($id)
    {
    	$data = ["iframeSrc" => action("NewsletterController@index", ["id"=>$id])];

    	return view("participant.promo", $data);
    }

}
