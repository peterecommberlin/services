

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

Przypominamy, że konkurs trwa do 30 września do 23:59 więc to zdecydowanie "ostatnia prosta"...

## Aktualna liczba głosów to: {{$votes}}

@component('mail::button', ['url' => $voteUrl])
Strona głosowania
@endcomponent

Przypominamy, że warunkiem wejścia do Agendy XVII Targów eHandlu w Warszawie jest uzyskanie **minimum 100 głosów** i zajęcie miejsca w **TOP3 w swojej kategorii**.

Ewentualna edycja zgłoszenia jest możliwa [pod tym linkiem]({{$accountUrl}})

Regards, 

Katarzyna Wicher

@endcomponent

