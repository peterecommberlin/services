

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

** W środę 5 grudnia startuje sprzedaż Early Bird na XVI Targi eHandlu w Krakowie, które odbędą się 17 kwietnia 2019 roku** 

Pula Early-Bird przewidziana jest **tylko i wyłącznie dla Wystawców minionych Targów** więc rezerwacja będzie możliwa przez dedykowany adres, który zostanie wysłany 20 minut przed startem sprzedaży.

Od **10:00** do 11:30 rezerwacji będą mogli dokonać Wystawcy z TOP 30 Rankingu Konkursu dla Wystawców

0 **12:00** rozpocznie się możliwość rezerwacji dla pozostałych Wystawców minionych Targów.

O **13:00** startuje regularna, publiczna, sprzedaż stoisk dla Wszystkich zainteresowanych, która potrwa do końca roku lub wyczerpania puli.

@component('mail::button', ['url' => "https://res.cloudinary.com/eventjuicer/image/upload/v1543500169/teh16krk.jpg"])
Zobacz orientacyjny plan stoisk
@endcomponent

Pozdrawiam, Adam Zygadlewicz

@endcomponent



