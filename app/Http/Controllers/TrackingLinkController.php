<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 

class TrackingLinkController extends Controller
{

 

    function __construct( )
    {

     
    }

    function index()
    {

        $data = json_decode(trim(file_get_contents("https://api.eventjuicer.com/v1/restricted/ranking?x-token=8b1d49a3c2085b121952f988364f4f47800fbc67")),true);
      

        return view("companies.trackinglinks", ["data" => array_get($data,"data", [])]);

    }





  

}
