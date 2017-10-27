
@extends('layouts.default')

@section('title', 'Link promo')


@section('content')

<form>
<div class="form-group">

<label for="exampleInputEmail1">Oto Twój link do promocji</label>

<textarea onFocus="this.select()" class="form-control">{{$promolink}}</textarea>

</div>
</form>

<p>Każdy nowy odwiedzający stronę Targów to punkt w <a href="{{ action("ParticipantPromoController@ranking", ["id" => $partner_id]) }}">rankingu</a></p>



@endsection


