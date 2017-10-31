<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Eventjuicer\Requests\ParticipantPromoCreative;
use Eventjuicer\Requests\ParticipantOwner;

use Eventjuicer\Services\ParticipantPromo;
use Eventjuicer\Services\ParticipantPromoCreatives;


use Eventjuicer\Services\ImageAddText;

class PromoCreativeController extends Controller
{

    protected $promo, $creatives;


    function __construct(ParticipantPromo $promo, 
        ParticipantPromoCreatives $creatives)
    {
        $this->promo = $promo;

        $this->creatives = $creatives;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            
            "cSocial"    => $this->creatives->filtered("social"),
            "cEmail"     => $this->creatives->filtered("email")
        ];

       // dd($this->promo->creatives());

        return view("promo.creatives.index", $data);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {

        $templates = $this->creatives->templates();

    
        $data = [

                "templates" =>  $templates,
        ];


         return view("promo.creatives.edit", $data);
    }


    public function generate($participant, $creative)
    {

        $target = $this->creatives->buildLocalFilename($creative);

        $img =  (new ImageAddText($this->creatives, $target))->build();

        return response()->json($this->creatives->buildPublicFilename($creative));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantPromoCreative $request, $participantId)
    {

        $data = $this->creatives->save( $request->all() );

        return redirect()->action("PromoCreativeController@show", 
            ["participantId" => $participantId, 
            "creative" => $data->id])->with("status", "Gotowe... "); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, $participant, $creative)
    {

        $data = [

            "creativeId" => $creative,
            "linkedin" => $this->creatives->buildLink($creative, "linkedin"),
            "facebook" => $this->creatives->buildLink($creative, "facebook"),
            "twitter" => $this->creatives->buildLink($creative, "twitter"),
            "link" => $this->creatives->buildLink($creative),
            "item" => $this->creatives->current(),
            "imageGenerateUrl" => action(class_basename(__CLASS__)."@generate", compact("participant", "creative"))

        ];

        return view("promo.creatives.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    protected function protect()
    {

    }
}
