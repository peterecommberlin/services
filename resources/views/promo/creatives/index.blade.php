






@extends('layouts.default')

@section('title', 'Kreacje')


@section('content')


@include('shared.did-you-know', ["title"=>"Oto generator indywidualnych kreacji na serwisy społecznościowe", "description"=>"Kliknij Utwórz nową aby zacząć. Wykorzystaj jeden z szablonów - dodaj własny tekst, który będzie widoczny na serwisach społecznościowych. Każda wygenerowana kreacja zawiera link trackingowy!", "action" => action("PromoCreativeController@create", compact("participantId")) ])



<div class="panel mt-3 mb-3">



</div>

<?php /*
<section id="creative_email" class="mt-5">

<h3>Stopki E-mail</h3>


</section>

*/?>

<section id="creative-social" class="mt-5">


<h3>Kreacje na serwisy społecznościowe</h3>


<div class="row">
@each('promo.creatives.item', $cSocial, 'item', 'promo.creatives.empty')
</div>


</section>





@endsection




@push('scripts')

<script type="text/javascript">

</script>

@endpush
