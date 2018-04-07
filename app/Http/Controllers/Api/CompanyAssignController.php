<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use Eventjuicer\Services\ApiUser;
use Eventjuicer\Services\ApiUserAssign;


class CompanyAssignController extends Controller
{

    protected $user;

    function __construct(ApiUser $user)
    {
      $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $assign = (new ApiUserAssign($this->user))->make(true);

        if($assign)
        {
            return response()->json(["status"=>true]);
        }
       
        return response()->json(["status"=>false]);

       
    }



}
