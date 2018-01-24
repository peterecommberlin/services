<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Eventjuicer\Services\ImageAddText;

class InvitesGeneratorController extends Controller
{

    function __construct()
    {
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $src = public_path("templates/invite.png");

       

        foreach(range(201, 250) as $number)
        {

            $vnumber = str_pad($number, 3, "0", STR_PAD_LEFT);

             $target = storage_path("app/public/zaproszenie_ekomersy_".$vnumber.".png");

              $texts = [[

                "x" => -12,
                "y" => 2,
                "w" => 80,
                "insert" => "text",
                "text" => "#". $vnumber,
                "s" => 8,
                "c" => "#ffffff"
            ]];

             $img =  (new ImageAddText($src, $texts, $target))->build();

        }


        return response()->json([]);

       
    }



}
