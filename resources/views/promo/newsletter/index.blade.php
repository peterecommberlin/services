
@extends('layouts.default')

@section('title', __('promo.newsletter_preview_pagetitle'))



@section('content')



@if(!empty($iframeSrc))


@include('shared.did-you-know', ["title"=>__("promo.newsletter_preview_tip_summary"), "description"=>__("promo.newsletter_preview_tip")])

<section>

<p>{{__('promo.newsletter_preview_title')}}</p>

<iframe src="{{$iframeSrc}}"></iframe>

</section>

<section id="newsletter-source">

<div>
<p>
  <a href="{{ action("PromoNewsletterController@download", ["participantId" => $participantId, "newsletterId" => 1]) }}" class="btn btn-primary">{{__("promo.newsletter_preview_download")}}</a>

  {{__("general.or")}}

 {{__("promo.newsletter_preview_source_copy")}}
</p>
</div>


<form>
<div class="form-group">

<textarea onFocus="this.select()" class="form-control source"></textarea>

</div>



</form>

</section>


@else

@include('shared.warning', [ "title" => "Coś jest nie tak.", "description" => "Nie możemy odnaleźć Twojego logotypu... to na pewno Twoje główne konto?"])

@endif

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


