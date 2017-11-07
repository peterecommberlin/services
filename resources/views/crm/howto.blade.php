@extends('layouts.nomenu')



@section('title', 'Skaner Kontaktów / Barcode Scanner')

@section('content')


<h4>{{$participantName}} Stoisko: {{$booth}}</h4>




<div class="row">
	
	<div class="col">

	<img src="https://d3vv6lp55qjaqc.cloudfront.net/items/2G1G192c0j3Y262D2o01/Monosnap%202017-05-10%2001-22-41.jpg" class="img-fluid" />

	</div>

	<div class="col">

	
	<img src="{{$qrcode}}" alt="QR CODE" />
	

	</div>


</div>



<div class="hero mt-3">



<ul style="list-style-type: nosne;">

<li class="mt-3">

	<h4>
		
	<strong>Ściągnij</strong> na telefon, którym chcesz zbierać kontakty, aplikację <strong>"Expo"</strong> z Google Play bądź App Store.

	</h4>

</li>

<li class="mt-3">

<h4>
Wejdź na stronę <strong>http://exhibitordeck.com</strong> z komórki i kliknij "Open it with Expo" 
</h4>

</li>

<li class="mt-3">
	
	<h4>
	Zeskanuj kod QR (w górnym prawym rogu) by się "zalogować".
	</h4>

	

</li>

<li class="mt-3">
	
<h4>
	Skanuj Zwiedzających
</h4>

</li>




<li  class="mt-3">

	<h4>
	
	<strong>Problemy techniczne?</strong> <br/>
	Wyślij SMS "skaner+Twój nr stoiska" na +48 724 770 331. 
	Postaramy się pojawić "na ASAPie" :P

	</h4>


</li>


</ul>


</div><!--row-->






@endsection
