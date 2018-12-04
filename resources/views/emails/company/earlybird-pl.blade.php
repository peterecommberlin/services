

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

W środę **5 grudnia** o godzinie **12:00** startuje sprzedaż Early Bird dla Wystawców poprzedniej edycji Targów (spoza TOP30 Konkursu dla Wystawców)

Rezerwacji będzie można dokonać do godziny 12:59 lub wyczerpania stoisk (o godzinie 13:00 startuje publiczna sprzedaż stoisk dla wszystkich zainteresowanych).

@component('mail::button', ['url' => "https://targiehandlu.pl/"])
Mapka stoisk
@endcomponent

**Link do tajnej strony, na której będzie można dokonać rezerwacji otrzymasz jutro ok. 11:45**.

Pozdrawiam, Adam Zygadlewicz

@endcomponent



