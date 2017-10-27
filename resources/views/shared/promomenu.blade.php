
















<ul class="nav nav-pills flex-column">



<li class="nav-item">
<a class="nav-link {{Request::is("*/promo") ? "active": "" }}" href="{{ action("ParticipantPromoController@index", ["id" => $partner_id]) }}">

	

	Link promo <span class="sr-only">(current)</span>
	
</a>
</li>




<li class="nav-item">
<a class="nav-link {{Request::is("*/newsletter") ? "active": "" }}" href="{{ action("ParticipantPromoController@newsletter", ["id" => $partner_id]) }}">Newsletter</a>
</li>


<li class="nav-item">
<a class="nav-link {{Request::is("*/ranking") ? "active": "" }}" href="{{ action("ParticipantPromoController@ranking", ["id" => $partner_id]) }}">Ranking</a>
</li>

<li class="nav-item">
<a class="nav-link {{Request::is("*/tutorial") ? "active": "" }}" href="{{ action("ParticipantPromoController@tutorial", ["id" => $partner_id]) }}">Przewodnik</a>
</li>


</ul>