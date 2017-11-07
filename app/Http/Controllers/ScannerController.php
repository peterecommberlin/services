<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Eventjuicer\Services\ParticipantPromo;

class ScannerController extends Controller
{

    function __construct(ParticipantPromo $promo)
    {
        $this->promo = $promo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($participant)
    {

        $data = [

            "booth"  => $this->promo->field("booth"),

            "qrcode" => "https://api.eventjuicer.com/v1/services/scanners/" . $this->promo->authQrCode()
        ];

        return view("crm.howto", $data);
    }



}
