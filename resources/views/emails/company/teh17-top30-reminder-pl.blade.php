

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

Już dzisiaj (w czwartek 16 maja) o godzinie **12:00** startuje sprzedaż Early Bird **dla TOP30 Rankingu Konkursu dla Wystawców** czyli dla Twojej firmy.

Tym razem rezerwacji będzie można dokonać aż **do piątku do 17:00** - sprzedaż dla pozostałych Wystawców z edycji w Krakowie (spoza TOP30) startuje dopiero w przyszłym tygodniu.

Pula stoisk jest ograniczona do 30.

@component('mail::button', ['url' => "https://admin.targiehandlu.pl/earybirdtop30s4s3s"])
Mapka i rezerwacja
@endcomponent

Gorąco pozdrawiamy,

Karolina Michalak, Jakub Przybylski

@endcomponent



