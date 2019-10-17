

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

# Warto przygotować ofertę specjalną dla Zwiedzającego

Pod adresem [https://targiehandlu.pl/offers](https://targiehandlu.pl/offers) **listujemy oferty specjalne Wystawców** dla Zwiedzających Targi.

# O co chodzi?

Chodzi o to, żeby zaoferować to czego nie można otrzymać przez formularz kontaktowy przez stronę internetową firmy. **Prawdziwy powód żeby szukać Twojego stoiska** na mapie Targów...

# Zasady promowania Super Ofert (góra strony i znaczek na liście Wystawców)

Oferta musi być **dostępna tylko dla Zwiedzających** (może być oczywiście limitowana ilościowo, czasowo, wielkością firmy...)

Oferta musi być **konkretna** (10% na nasze wszystkie usługi jest mało konkretne)

Jeśli są jakieś **warunki skorzystania** z Oferty muszą być wyrażone w jej treści

Oferta musi być atrakcyjna (musi być **"sexy"** jak to mawiają marketerzy... :-)

# Przykłady dobrych Super Ofert

@component('mail::panel')
Klienci, którzy spotkają się z naszym zespołem na targach eHandlu w Warszawie otrzymają ofertę z: Bezpłatną obsługą zwrotów - na jakikolwiek magazyn zagraniczny (...) trafi twoja zwrotna przesyłka, otrzymasz ją bezpłatnie pod Twój adres w Polsce.
@endcomponent


@component('mail::panel')
50% rabatu na usługę (...) na pierwszy rok działania sklepu,
Migrację z innej platformy na platformę (...) z usługą Premium za 1 zł!
@endcomponent

@component('mail::panel')
Dla klientów, którzy rozpoczynają współpracę po kontakcie podczas targów eHandlu, pierwszy miesiąc magazynowania gratis!
@endcomponent

# Przykłady Super Ofert, których nie będziemy promować

@component('mail::panel')
Odwiedź nasze stoisko XXX i skorzystaj z darmowych testów!
@endcomponent

**brakuje info czego mają dotyczyć testy, jakie są ograniczenia**

@component('mail::panel')
Przyjdź do nas na stoisko XXX i sprawdź, co możemy zrobić dla poprawy działania Twojego biznesu. Dla uczestników TeH specjalne kody rabatowe.
@endcomponent

**oferta jest mało konkretna**

@component('mail::panel')
Bezpłatne zdjęcia testowe dla klientów.
@endcomponent

**oferta jest mało konkretna. zdjęcia produktów? jakiego typu? jakie są ograniczenia oferty?**

# Jak edytować Super Ofertę?

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do swojego konta
@endcomponent

W **Dane Firmy** szukaj pozycji "Oferta specjalna na Targi".

# Gdzie są promowane Super Oferty?

pod adresem [https://targiehandlu.pl/offers](https://targiehandlu.pl/offers) 

na liście Wystawców na stronie głównej **czerwony przypis Oferta**

**Super oferty będą promowane na samym wydarzeniu w bardzo widocznym miejscu**


Regards, 

Jakub Przybylski

Karolina Michalak

@endcomponent

