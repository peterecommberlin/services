

@component('mail::message')

Cześć {{ $p->translate("[[fname]]") }}!

# Pracujemy nad przygotowaniem kolejnej edycji **Targów eHandlu w Krakowie - 22 kwietnia!**

Kończymy [kompletowanie listy Wystawców](https://targiehandlu.pl/exhibit) i planujemy agendę **aż 6 scen prezentacyjnych**

...ale potrzebujemy Twojej pomocy!

# Będzie nam bardzo miło jeśli poświęcisz chwilę i wskażesz prezentacje, które szczególnie zasługują na swój slot prezentacyjny na nadchodzących Targach.

@component('mail::button', ['url' => "https://targiehandlu.pl/vote"])
Wybierz prezentacje, które chcesz zobaczyć
@endcomponent

** Do głosowania wymagane jest konto w serwisie LinkedIn. Każdy głosujący ma 10 głosów.**

Pozdrawiam! 

Katarzyna Wołyńska

[Wypisz się z listy]({!! $unsubscribe !!})

@endcomponent



