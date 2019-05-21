

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**Dzisiaj (21 maja) o 12:00**, startuje sprzedaż stoisk na jesienne Targi eHandlu w Warszawie dla Wystawców minionej edycji w Krakowie.

@component('mail::button', ['url' => "https://admin.targiehandlu.pl/earybirdtop30s4s3s"])
REZERWACJA TYLKO TUTAJ
@endcomponent

Pula będzie **limitowana** (tylko ok 20 stoisk). **O godzinie 13:00** planowane jest  uruchomienie kolejnej puli stoisk (tym razem publicznie otwartej - widocznej na stronie głównej Targów eHandlu i przeznaczonej dla wszystkich zainteresowanych.).

Gorąco pozdrawiamy,

Karolina Michalak, Jakub Przybylski

@endcomponent



