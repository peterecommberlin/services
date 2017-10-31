







<ul class="nav nav-pills flex-column">


<li class="nav-item">
<a class="nav-link {{Request::is("*/promo") ? "active": "" }}" href="{{ action("PromoController@index", ["participantId" => $participantId]) }}">

	Link promo <span class="sr-only">(current)</span>
	
</a>
</li>


<li class="nav-item">
<a class="nav-link {{Request::is("*/creatives*") ? "active": "" }}" href="{{ action("PromoCreativeController@index", ["participantId" => $participantId]) }}">Kreacje</a>

</li>

<li class="nav-item">
<a class="nav-link {{Request::is("*/newsletters*") ? "active": "" }}" href="{{ action("PromoNewsletterController@index", ["participantId" => $participantId]) }}">Newsletter</a>
</li>


<li class="nav-item">
<a class="nav-link {{Request::is("*/ranking") ? "active": "" }}" href="{{ action("PromoController@ranking", ["participantId" => $participantId]) }}">Ranking</a>
</li>

<li class="nav-item">
<a class="nav-link {{Request::is("*/logistics") ? "active": "" }}" href="{{ action("PromoController@logistics", ["participantId" => $participantId]) }}">Logistyka XIII Targi eHandlu</a>
</li>


<li class="nav-item">
<a class="nav-link {{Request::is("*/learn") ? "active": "" }}" href="{{ action("PromoController@learn", ["participantId" => $participantId]) }}">Event marketing</a>
</li>



</ul>