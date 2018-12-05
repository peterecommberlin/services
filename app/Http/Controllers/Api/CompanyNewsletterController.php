<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


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

       app()->setLocale("pl");

       config(["app.name" => "XVI Targi eHandlu - 17.04.2019"]);

    }

    public function show(Request $request, int $id)
    {

        $companydata = $this->user->companydata();

        $source = array_get(
        
          $companydata, "logotype_cdn", 
          array_get(
            $companydata, "logotype"
          )
        );

        if( empty($source) )
        {
          
            abort(500, "image not found");
        }


       $newsletter = (new ExhibitorInvite(
       
                   $this->user->company(), 
               
                   (string) $source , 
               
                   $this->user->companyPublicProfile().

                   $this->user->trackingLink("email", "button"),
               
                   "Spotkajmy się na XV Targach eHandlu w Warszawie!",
               
                   'emails.exhibitor.invite' . $id
       
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
        
        $zip = new ZipStream("teh15_waw_newsletter_".$id . ".zip");

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
