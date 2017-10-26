<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantPromoController extends Controller
{
    function __construct()
    {

    }


    function index()
    {
    	return view("participant.promo");
    }

}
