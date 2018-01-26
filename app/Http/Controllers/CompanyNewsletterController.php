<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Eventjuicer\Services\ApiUser;
use Eventjuicer\Services\ImageEncode;
use Eventjuicer\ValueObjects\RichContent;
use Eventjuicer\Repositories\ParticipantRepository;

use App\Mail\ExhibitorInvite;
use ZipStream\ZipStream;


class CompanyNewsletterController extends Controller
{
    protected $user;

    function __construct(ApiUser $user, ParticipantRepository $participants, Request $request)
    {
       
       $participant = $participants->find($request->input("participant_id"));

       if(!$participant)
       {
        abort(404, "cannot find user :/");
       }

       $this->user = $user;

       $this->user->setToken($participant->token);

       app()->setLocale("en");

       config(["app.name" => "E-commerce Berlin #3"]);
 
        
    }

    public function show(Request $request, int $id)
    {

        $source = $this->user->logotype(); //switchToParent!

        $filename = md5($source) . ".jpg";
        $publicSource = asset("storage/" . $filename);
        $localTarget = storage_path("app/public/" . $filename);

        $image =  (new ImageEncode($source , $localTarget))->save();




       $newsletter = (new ExhibitorInvite(
       
                   $this->user->user(), 
               
                   (string) $publicSource , 
               
                   $this->user->trackingLink("email", "button"),
               
                   "Meet us at the E-Commerce Berlin Expo 2018!",
               
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

        if($request->input("html"))
        {
            return $newsletter;
        }

        return response()->outputAsPlainText( $newsletter, request()->getHttpHost() );

    }


    public function zip($id, $source)
    {
        
        $zip = new ZipStream("ecommerce_berlin_expo_newsletter_".$id . ".zip");

        $images = (new RichContent($source))->images();

        $c = 1;

        foreach($images as $image)
        {

       //   $fp = fopen('php://memory', 'r+');

          $fp = tmpfile();

          $extension = $image->ext();


          fwrite($fp, $image->data());

          fflush($fp);
          rewind($fp);


          $targetPath = 'images/'.$c.'.' .$extension;

          //replace in source...

          $source = str_replace((string) $image, $targetPath, $source);

          $zip->addFileFromStream("newsletter/" . $targetPath, $fp);

          fclose($fp);

          $c++;

        }

        $zip->addFile('newsletter/index.html', $source);

        //$zip->addFileFromPath('some_image.jpg', 'path/to/image.jpg');

        return $zip->finish();
    }

   


}
