

@component('mail::message')
 
# Dzień dobry, {{$profile->translate("[[fname]]")}},

## Sprawdziliśmy profil Twojej firmy na stronie Targów Ehandlu - prosimy o pilne poprawki. 

@foreach ($errors as $f => $p)
	
**{{$f}}** {{$p}}

@endforeach

@component('mail::button', ['url' => $accountUrl])
Chcę poprawić teraz!  
@endcomponent

Zobacz jak wygląda przykładowy [wypełniony i sformatowany]({{$exampleUrl}}) profil Wystawcy.  
Profil Twojej firmy wygląda teraz [tak]({{$profileUrl}})

@component('mail::panel')
profile firm Wystawców będą **stałe pomiędzy edycjami Targów** więc warto się zaangażować (praca nie pójdzie na marne.) 

podczas tej edycji nie będziemy drukowali papierowych planów targowych - informacje online będą podstawowym źródłem decyzji Zwiedzających 
@endcomponent


Pozdrowienia, Bartek Meller

@endcomponent



