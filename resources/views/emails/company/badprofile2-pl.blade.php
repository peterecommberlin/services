

@component('mail::message')
 
# Dzień dobry, {{$profile->translate("[[fname]]")}},

## Sprawdziliśmy profil Twojej firmy na stronie Targów Ehandlu - **wymaga poprawek**.

@foreach ($errors as $f => $p)
	
**{{$f}}** {{$p}}

@endforeach

@component('mail::button', ['url' => $accountUrl])
Zaloguj mnie do panelu - chcę poprawić teraz  
@endcomponent

Profil Twojej firmy wygląda teraz [tak]({{$profileUrl}})

Zobacz jak wygląda przykładowy [wypełniony i sformatowany]({{$exampleUrl}}) profil Wystawcy.  

Pozdrowienia, Adam Zygadlewicz

@endcomponent



