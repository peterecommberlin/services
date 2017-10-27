
@extends('layouts.default')

@section('title', 'Ranking')




@section('content')


<div class="alert alert-primary" role="alert">
 <strong>Tip:</strong> 
  
  Aby wziąć udział w grze musisz promować swój udział w Targach.<br/>


  Masz do dyspozycji <a href="{{action("ParticipantPromoController@index", ["id" => $partner_id])}}">specjalny link</a> (zliczający punkty) oraz dedykowany <a href="{{action("ParticipantPromoController@newsletter", ["id" => $partner_id])}}">newsletter</a>.

</div>  


<div id="ranking"></div>


@endsection


