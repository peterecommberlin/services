<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Eventjuicer\Services\SendAdminMessage;
use Eventjuicer\Services\SparkPost;


class SendAdminMessageController extends Controller
{
    

 
    public function store(SparkPost $spark, SendAdminMessage $service, Request $request)
    {
        $data = $this->postData();

        $errors = $service->validate($data);

        if(count($errors))
        {
            return $this->jsonError($errors, 500);
        }

        $recipients = $service->make( 
            $data["ids"], 
            array_get($data, "event_id", 0),
            (bool) array_get($data, "unique", 1),
            false
        );

        $data = $service->legacy($data);

        $status = $spark->bulk(
            $recipients,
            $data
        );

        return response()->json(["data", $status]);
    }

 
    
}
