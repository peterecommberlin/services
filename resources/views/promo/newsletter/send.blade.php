
@extends('layouts.default')

@section('title', 'Newsletter promujący udział w Targach')



@section('content')


<?php /*


<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Nadawca / Sender</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Temat</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <label for="exampleInputEmail1">Wklej adresy e-mail</label>

     <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"></textarea>

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


*/ ?>





<section>



<p>Podgląd</p>

<iframe src="{{$iframeSrc}}"></iframe>


<div class="alert alert-success" role="alert">
 <strong>Tip:</strong> 
  Poniższy newsletter zawiera już odpowiedni link trackingowy
</div>  


</section>

<section id="newsletter-source">

<div>
<p>
  <a href="{{ action("PromoNewsletterController@download", ["participantId" => $participantId, "newsletterId" => 1]) }}" class="btn btn-primary">Pobierz na dysk</a>

lub skopiuj źródło poniżej
</p>
</div>


<form>
<div class="form-group">

<textarea onFocus="this.select()" class="form-control source"></textarea>

</div>



</form>

</section>


@endsection




@push('scripts')

<script type="text/javascript">


jQuery(function(){

  var newsletterSourceUrl = "{{$newsletterSourceUrl}}";
  var target = jQuery("textarea.source");

  axios.get(newsletterSourceUrl)
  .then(function (response) {
    target.text(response.data);
  })
  .catch(function (error) {
    console.log(error);
  });

});



</script>

@endpush


