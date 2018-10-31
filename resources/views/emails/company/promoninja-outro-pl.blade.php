

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

# Pierwszy etap Konkursu za nami. Prezentacje na scenach A i B otrzymują:

eStrategie.pl	(1025 punktów)

KPI Media Sp. z o.o. (739 punktów)

Gratulujemy i dziękujemy za zaangażowanie!

# Ale to nie koniec!

Konkurs trwa do 23:59 6 listopada i **nadal można wygrać bardzo cenne świadczenia**:

Mega pakiet zaproszeń w aplikacji do zapraszania Zwiedzających (**standardowo możesz zaprosić tylko 5 Zwiedzających...** uzyskując wynik min 20 punktów masz już 55 zaproszeń!)

Wywiad wideo z przedstawicielem firmy na stoisku

Dostęp do najtańszej puli sprzedaży na kolejne Targi

Aplikacja do skanowania badgów

Roll-up w strefie Business Lounge


# Poniżej info o co chodzi w Konkursie

Konkurs polega na posługiwaniu się ** "specjalnym linkiem zliczającym punkty"** lub indywidualnymi materiałami promocyjnymi, które przygotowaliśmy i które już zawierają w sobie ten link. Wszystkie materiały linkują do Twojego profilu na stronie Targów eHandlu.

Oto Twój **link trackujący!** Wystarczy, że Twoje newslettery, stopki @, reklamy, posty w serwisach społecznościowych będą linkowały do Twojego profilu na stronie Targów eHandlu za pomocą poniższego linka i bierzesz udział w Wyzwaniu.

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

# W Panelu Wystawcy czekają na Ciebie 4 ważne strony 

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do Panelu Wystawcy 
@endcomponent

# RANKING

Ranking tworzony jest **z opóźnieniem ok 24h** na podstawie danych z Google Analytics.
Codziennie będziesz mógł zobaczyć jaki jest wynik Twoich i innych Wystawców działań z dnia poprzedniego.

## NAGRODY

Każda nagroda ma warunki jej przyznania: 

* co do minimalnej liczby punktów 
* co do pozycji w rankingu. Przy każdej pozycji nagrody widzisz czy biorąc pod uwagi stan punktów z dnia poprzedniego miał(a)byś ją przyznaną.

## SZABLONY NEWSLETTERA

2 szablony (polski i angielski), które informują o tym, że Twoja firma będzie na Targach eHandlu. Szablony mają link, który prowadzi do Twojego profilu i zlicza punkty.
Każdy newsletter możesz pobrać jako **paczkę ZIP i wczytać do programów typu Freshmail, GetResponse, Mailchimp**...

## MATERIAŁY PROMOCYJNE

To 3 oddzielne linki, które możesz udostępniać na serwisach społecznościowych. każdy z nich generuje inną grafikę jako podgląd (2 z Twoim logotypem... i jedna to Twoja własna kreacja jeśli podano URL do niej w Danych firmy).

Każdy z linków do grafiki możesz skopiować do schowka i wysłać via @, messenger, dodać do własnego newslettera.

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do Panelu Wystawcy 
@endcomponent

## Chcesz użyć własnych materiałów promocyjnych? Użyj linku poniżej: 

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Pozdrawiam, 

Adam Zygadlewicz

@endcomponent

