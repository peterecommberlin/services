

@component('mail::message')
 
# Dzień dobry {{ array_get($profile, "fname") }},

Uruchomiliśmy [ehandel.com.pl](https://ehandel.com.pl/) - serwis informacyjny, w którym chcemy publikować informacje pochodzące od dostawców rozwiązań dla sklepów internetowych.

Każdy dostawca produktów i usług do prowadzenia eHandlu będzie miał link do własnych materiałów (przykład: [Poczta Polska](https://ehandel.com.pl/authors/poczta-polskapl))

@component('mail::panel')
Publikacja jest bezpłatna. Zachęcamy do nadsyłania materiałów na **redakcja@ehandel.com.pl** (lub przekazania adresu działowi/agencji PR)
@endcomponent

Korzystając z okazji polecamy lekturę [wywiadu z Pawłem Piotuchem z IdoSell](https://ehandel.com.pl/pawel-piotuch-idosell,1894)


Z pozdrowieniami,

Karolina Michalak


@endcomponent