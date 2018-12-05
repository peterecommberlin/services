

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

Dzisiaj o godzinie **12:00** startuje sprzedaż Early Bird dla Wystawców poprzedniej edycji Targów (spoza TOP30 Konkursu dla Wystawców)

Rezerwacji będzie można dokonać do godziny 12:59 **lub wyczerpania stoisk w tej puli** 

@component('mail::button', ['url' => "https://targiehandlu.pl/teh16top30erlbrd"])
Rezerwacja tylko tutaj
@endcomponent

**O 12:00 musisz korzystać z powyższej strony. Rezerwacja przez stronę główną nie będzie możliwa**.

O godzinie 13:00 startuje publiczna sprzedaż stoisk dla wszystkich zainteresowanych. Jeśli nie udało się Tobie kupić stoiska z danej strefy atrakcyjności o 12:00 polecamy rezerwację o 13:00.

Pozdrawiam, Adam Zygadlewicz

@endcomponent



