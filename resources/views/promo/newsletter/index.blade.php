
@extends('layouts.default')

@section('title', 'Newsletter promujący udział w Targach')



@section('content')


@include('shared.did-you-know', ["title"=>"Nic tylko wysłać!", "description"=>"Poniższy newsletter jest zaproszeniem do odwiedzenia Twojego stoiska. Newsletter zawiera specjalny link zliczający punkty."])


<section>

<p>Podgląd newslettera</p>

<iframe src="{{$iframeSrc}}"></iframe>

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


