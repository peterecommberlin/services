

@component('mail::message')
 
# Cześć {{ array_get($profile, "fname") }},

**Od soboty Warszawa znalazła sie w tzw. "czerwonej strefie" zagrożenia epidemicznego, warszawska edycja Targów eHandlu zostaje odwołana z przyczyn niezależnych od organizatora.**

Następna edycja Targów odbędzie się prawdopodobnie 10 czerwca 2021 w Warszawie.

Dla Wystawców przewidzieliśmy 2 drogi rozwiązania umowy: 1) rozwiązania umowy (z potrąceniem 30% wpłaty tytułem poniesionych przez organizatora kosztów organizacji) 2) zaliczenie opłaty na poczet kolejnej edycji (obowiązuje dopłata 15%) 

Prosimy pobrać stosowne oświadczenie i odesłać do nas do 30 października.

@component('mail::button', ['url' => "https://res.cloudinary.com/eventjuicer/image/upload/v1602848003/TEH-OswiadczenieWystawcy-RozwiazanieUmowy.pdf"])
Rozwiązanie umowy
@endcomponent

@component('mail::button', ['url' => "https://res.cloudinary.com/eventjuicer/image/upload/v1602848003/TEH-OswiadczenieWystawcy-PrzeniesienieRezerwacji.pdf"])
Przeniesienie opłaty
@endcomponent

**W przypadku kiedy wysłano do nas już oświadczenie o chęci dopłaty 25% (analiza możliwości przeniesienia Targów na życzenie Wystawców zanim ogłoszono "czerwoną strefę") i nadal chcielibyście Państwo przenieść opłatę, możemy odesłać nasze oświadczenie o obniżeniu dopłaty z 25% do 15% (prośba o stosowną informację zwrotną).**


Z pozdrowieniami,

Karolina Michalak

Adam Zygadlewicz

@endcomponent