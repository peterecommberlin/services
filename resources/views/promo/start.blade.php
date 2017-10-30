
@extends('layouts.default')

@section('title', 'Link promo')




@section('content')


@include('shared.did-you-know', ["title"=>"", "description" => ''])



<form>

<div class="form-group">

<label for="exampleInputEmail1">Oto Twój link do promocji</label>

<textarea onFocus="this.select()" class="form-control">{{$link}}</textarea>

</div>
</form>



@endsection


