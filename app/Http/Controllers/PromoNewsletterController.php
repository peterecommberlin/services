<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ExhibitorInvite;
use Eventjuicer\Services\ImageEncode;
use Eventjuicer\Services\ParticipantPromo;
use Eventjuicer\Services\ParticipantPromoCreatives;

use ZipStream\ZipStream;

use Eventjuicer\Services\ImageShared;
use Exception;


class PromoNewsletterController extends Controller
{
    protected $promo, $creatives;

    function __construct(ParticipantPromo $promo, ParticipantPromoCreatives $creatives)
    {

        $this->promo = $promo;

        $this->creatives = $creatives;

        //we should check if we have customlink

        $this->creatives->autogenerateIfNone("newsletter");

    }

    function index($participantId)
    {

        $data = [

            "iframeSrc" => action(
                class_basename(__CLASS__)."@raw", 
                ["participantId"=>$participantId, "newsletterId" => 1]
                ),

            "newsletterSourceUrl" => action(
                    class_basename(__CLASS__) . "@source", 
                    ["participantId"=>$participantId, "newsletterId" => 1]
                
            )
        ];


        //check if we have image!

        try {

            new ImageShared($this->promo->participantImage());
        }
        
        catch (Exception $e)
        {
            $data = [
                "iframeSrc" => "",
                "newsletterSourceUrl" => ""
            ];
        }

    
    	return view("promo.newsletter.index", $data);
    }










    function raw()
    {

       $creative = $this->creatives->filtered("newsletter")->first();

       $target = $this->creatives->buildLocalFilename($creative);

       $image =  (new ImageEncode( $this->promo->participantImage(), $target))->save();

       $filename = $this->creatives->buildPublicFilename($creative);

       $newsletter = new ExhibitorInvite(
    		$this->promo->participant(), 
    		(string) $filename , 
    		$this->creatives->buildLink($creative->id),
    		"Spotkajmy się 8 listopada w Warszawie!");

       $render = $newsletter->render();

    	file_put_contents(

            $this->creatives->buildLocalFilename($creative, "html"),
    		$render
    	);

    	return $render;

    }

    function zip()
    {
        
        $creative = $this->creatives->filtered("newsletter")->first();

        # create a new zipstream object
        $zip = new ZipStream("newsletter_teh13_".$this->creatives->buildFilename($creative, "zip"));

        $filename = $this->creatives->buildFilename($creative);


        # create a file named 'hello.txt' 
        $zip->addFile('index.html', $this->raw());

        $zip->addFileFromPath('images/'.$filename, $this->creatives->buildLocalFilename($creative));

        # add a file named 'some_image.jpg' from a local file 'path/to/image.jpg'
        //$zip->addFileFromPath('some_image.jpg', 'path/to/image.jpg');

        # finish the zip stream
        return $zip->finish();
    }

    function download()
    {	
    	return response()->downloadViewAsHtml( $this->raw() );
    }

    function source()
    {	
   
    	return response()->outputAsPlainText( $this->raw() );
    }


}
