<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;


use Eventjuicer\Services\ApiUser;
use Eventjuicer\Services\ImageEncode;
use Eventjuicer\ValueObjects\RichContent;
use Eventjuicer\ValueObjects\CloudinaryImage;

use Eventjuicer\Repositories\ParticipantRepository;

use App\Mail\ExhibitorInvite;
use ZipStream\ZipStream;



class CompanyNewsletterController extends Controller
{
    protected $user;
    protected $pathPrefix = "";
    protected $appName = "";
    protected $baseHost = "";

    function __construct(ApiUser $user, ParticipantRepository $participants, Request $request)
    {
       
       $participant = $participants->find($request->input("participant_id"));

       if(!$participant)
       {
        abort(404, "cannot find user :/");
       }

       $this->user = $user;

       $this->user->setToken($participant->token);


       //this could be handled by middleware?

      if($this->user->company()->group_id == 1) {
        app()->setLocale("pl");
        $this->appName = "17 Targi eHandlu - 22.10.2019";
        $this->baseHost = "https://targiehandlu.pl/";
      }
      else
      {
        $this->pathPrefix = "ebe-";
        app()->setLocale("en");
        $this->appName = "E-commerce Berlin Expo";
        $this->baseHost = "https://ecommerceberlin.com/";
        
      }

      config(["app.name" => $this->appName]);

    }

    public function show(Request $request, int $id)
    {

        $cd = $this->user->companydata(["company", "admin"]);

        $logotype = new CloudinaryImage(
          array_get($cd, "logotype_cdn")
        );

        if(! $logotype->isValid()){
          $logotype = new CloudinaryImage(array_get($cd, "logotype"));
        }

        if( empty($logotype) || strpos($logotype, "http") === false )
        {
          
            abort(500, "image not found");
        }

       $newsletter = (new ExhibitorInvite(
       
                   $this->user->company(), 
               
                   $logotype->thumb(), 
               
                   $this->user->companyPublicProfile($this->baseHost).

                   $this->user->trackingLink("email", "button"),
               
                   $this->appName,
               
                   'emails.exhibitor.'.$this->pathPrefix.'invite' . $id
       
               ))->render();


        if($request->input("dl"))
        {
            return response()->downloadViewAsHtml( $newsletter, str_slug($this->appName) );
        }

        if($request->input("zip"))
        {
            return $this->zip($id, $newsletter);
        }

        if($request->input("html"))
        {
            return $newsletter;
        }

        return base64_encode($newsletter);

       //return response()->outputAsPlainText( $newsletter, str_slug($this->appName) );

    }


    public function zip($id, $source)
    {
        
        $zip = new ZipStream(str_slug($this->appName).$id . ".zip");

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
