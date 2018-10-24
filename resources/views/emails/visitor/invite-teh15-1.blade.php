

@component('mail::message')

# Cześć {{$p->translate("[[fname]]") }}!

Opublikowaliśmy część agendy **XV Targów eHandlu w Warszawie**. Podobnie jak w poprzednich edycjach wstęp na EXPO i PREZENTACJE jest bezpłatny (wymagana rejestracja na stronie) 

## Wśród prelegentów m.in. 

Skuteczny doradca **sprzedaży na Amazon.com** - Damian Wiszowaty - Founder & CEO @ Gonito, BlockBust

Rozchwytywany **szkoleniowiec zespołów sprzedażowych** - Bartosz Majewski - CEO & Founder @ Casbeg 

Współwórca czołowej polskiej platformy do sprzedaży online - Paweł Fornalski - Founder & CEO @ IdoSell / IAI S.A.


@component('mail::button', ['url' => $registerURl])
	Chcę bezpłatny bilet
@endcomponent

Targi eHandlu to oczywiście przede wszystkim Targi! :) 
Oto [lista wszystkich Wystawców]({{ $exhibitorsURl }})

**Widzimy się? :)**

Pozdrawiam! 

Adam Zygadlewicz, Targi eHandlu


<a href="{{$siteUrl}}"><img src="http://res.cloudinary.com/eventjuicer/image/upload/c_fit,w_650/v1523564269/welcome1.jpg" alt="miłe twarze cudownych Uczestników" style="margin: 10px auto;" /></a>


@endcomponent



