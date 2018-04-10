

@component('mail::message')
 
# Dzień dobry, {{$profile->translate("[[fname]]")}},

## Sprawdziliśmy [profil Twojej firmy]({{$profileUrl}}) na stronie Targów Ehandlu - prosimy o pilne poprawki. 

@foreach ($errors as $f => $p)
	
**{{$f}}** {{$p}}

@endforeach

@component('mail::button', ['url' => $accountUrl])
Chcę poprawić teraz!  
@endcomponent

Zobacz jak wygląda przykładowy [wypełniony i sformatowany]({{$exampleUrl}}) profil Wystawcy.

@component('mail::panel')
profile firm Wystawców będą **stałe pomiędzy edycjami Targów** więc warto się zaangażować (praca nie pójdzie na marne.) 

na dniach podamy szczegóły konkursu, w którym będzie można wygrać świadczenia promocyjne o wartości ponad 20 000 pln. dobrze wypełniony, ładnie sformatowany profil firmy to możliwość szybkiego startu w rywalizacji.

podczas tej edycji nie będziemy drukowali papierowych planów targowych - informacje online będą podstawowym źródłem decyzji Zwiedzających
@endcomponent


Pozdrowienia, Bartek Meller

@endcomponent



