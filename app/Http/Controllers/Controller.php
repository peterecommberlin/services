<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/*custom*/
use Illuminate\Http\JsonResponse;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	final protected function postData()
	{
		return json_decode(app("request")->getContent(), true);
	}


	final function jsonError($msg = "", $code = 404, $params = [])
	{
		return (
			new JsonResponse(
				["error"=>[
					"code" => $code, 
					"message" => $msg, 
					"params" => $params 
					]
				], $code
			)
		);
	}




}
