<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Eventjuicer\Services\ApiUser;
use Eventjuicer\Services\ImageEncode;
use App\Mail\ExhibitorInvite;
use ZipStream\ZipStream;


class CompanyNewsletterController extends Controller
{
    protected $user;

    function __construct(ApiUser $user)
    {
       
       $this->user = $user;
       
       app()->setLocale("en");
       config(["app.name" => "E-commerce Berlin #3"]);
        
    }

    public function show(Request $request, int $id)
    {

        $file = $this->user->logotype();

        $publicFilename = asset("storage/" . md5($file) . ".jpg");

        $localTarget = storage_path("app/public/" . md5($file) . ".jpg");

        $image =  (new ImageEncode($file , $localTarget))->save();

       $newsletter = (new ExhibitorInvite(
       
                   $this->user->user(), 
               
                   (string) $publicFilename , 
               
                   $this->user->trackingLink(),
               
                   "e-commerce berlin expo #3",
               
                   'emails.eb3-exhibitor-' . $id
       
               ))->render();


        if($request->input("dl"))
        {
            return response()->downloadViewAsHtml( $newsletter, request()->getHttpHost() );
        }

        if($request->input("zip"))
        {
            return $this->zip($id, $newsletter);
        }

        return response()->outputAsPlainText( $newsletter, request()->getHttpHost() );

    }


    public function zip($id, $source)
    {
        
        $zip = new ZipStream("newsletter_eb3_".$id . ".zip");

        $zip->addFile('index.html', $source);

        $url = $this->user->logotype();


        $fp = tmpfile();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_exec($ch);


        fflush($fp);
        rewind($fp);

        $zip->addFileFromStream('images/test.png', $fp);
        
        fclose($fp);

        # add a file named 'some_image.jpg' from a local file 'path/to/image.jpg'
        //$zip->addFileFromPath('some_image.jpg', 'path/to/image.jpg');

        # finish the zip stream
        return $zip->finish();
    }

   


}
