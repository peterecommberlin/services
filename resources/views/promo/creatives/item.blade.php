

@inject("creatives", "Eventjuicer\Services\ParticipantPromoCreatives")



<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">

	


<div class="card mt-3 mb-2" >

<div class="card-header">
    {{ $item->name }}
  </div>


  <img class="card-img-top" src="{{ $creatives->buildPublicFilename($item) }}?{{time()}}" alt="" />

  <div class="card-body">
    <h4 class="card-title">{{ array_get($item->data, "title") }}</h4>
    <p class="card-text">{{ array_get($item->data, "description") }}





    </p>
   

   <a href="{{action("PromoCreativeController@show", [$participantId, $item->id])}}" class="btn btn-success">Wykorzystaj</a>

  </div>




</div>


</div>




