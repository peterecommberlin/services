

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

Na profilu zgłoszonej przez Ciebie prezentacji odkryliśmy aktualną liczbę głosów 

## Aktualna liczba głosów to: {{$votes}}

@component('mail::button', ['url' => $voteUrl])
Przejdź do profilu
@endcomponent

Przypominamy, że warunkiem wejścia do Agendy XVII Targów eHandlu w Warszawie jest uzyskanie **minimum 100 głosów** i zajęcie miejsca w **TOP3 w swojej kategorii**.

Edycja zgłoszenia jest możliwa [pod tym linkiem]({{$accountUrl}})

Regards, 

Katarzyna Wicher

@endcomponent

