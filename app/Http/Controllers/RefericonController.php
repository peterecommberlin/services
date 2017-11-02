<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class RefericonController extends Controller
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

        return view("refericon", []);
    }



}
