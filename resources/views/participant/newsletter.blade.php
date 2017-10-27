
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


<form>
  <a href="{{ action("NewsletterController@download", ["id"=>$partner_id]) }}" class="btn btn-primary">Pobierz na dysk</a>

  <a href="#newsletter-source" class="btn btn-default">Skopiuj źródło</a>
</form>


<section>

<div class="alert alert-success" role="alert">
 <strong>Tip:</strong> 
  Poniższy newsletter zawiera już odpowiedni link trackingowy
</div>  

<p>Podgląd</p>

<iframe src="{{$iframeSrc}}"></iframe>

</section>

<section id="newsletter-source">

<p>Źródło HTML Newslettera (możesz skopiować do edytora)</p>

<form>
<div class="form-group">

<textarea onFocus="this.select()" class="form-control source">{{$textareaSrc}}</textarea>

</div>
</form>

</section>


@endsection


