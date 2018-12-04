

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

W środę **5 grudnia** o godzinie **10:00** startuje sprzedaż Early Bird **dla TOP30 Rankingu Konkursu dla Wystawców** czyli dla Twojej firmy.

Rezerwacji będzie można dokonać do godziny 11:30 (O 12:00 startuje sprzedaż dla pozostałych Wystawców, tj spoza TOP30)

@component('mail::button', ['url' => "https://targiehandlu.pl/teh16top30erlbrd"])
Tajna strona do rezerwacji
@endcomponent

Pozdrawiam, Adam Zygadlewicz

@endcomponent



