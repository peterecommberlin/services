
@extends('layouts.default')

@section('title', 'Link promo')




@section('content')


@include('shared.did-you-know', ["title"=>"Twój uniwersalny link trackingowy", "description" => 'Link przekierowuje do strony głównej Targów eHandlu z odpowiednimi parametrami Google Analytics, które pozwalają na przypisanie Tobie punktów w Rankingu.'])



<form>

<div class="form-group">

<label for="exampleInputEmail1">Oto Twój link do promocji</label>

<textarea onFocus="this.select()" class="form-control">{{$link}}</textarea>

</div>
</form>



@endsection


