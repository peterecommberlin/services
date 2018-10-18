

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**W Panelu Wystawcy pojawiła się opcja dodania Przedstawicieli Wystawcy na stoisku**

@component('mail::button', ['url' => $accountUrl])
Dodaj / usuń Przedstawicieli 
@endcomponent

Przypominamy, że w ramach wykupionej przestrzeni wystawienniczej otrzymujesz 4 vouchery obiadowe i 1 kartę parkingową.

**Jeśli dodasz więcej niż 4 Przedstawicieli Wystawcy** skontaktujemy się z Tobą czy pragniesz zwiększyć liczbę voucherów obiadowych (koszt 45 pln netto / os).

Możesz oczywiście proaktywnie dać nam znać w odpowiedzi na tę wiadomośc.

Pozdrawiam, Adam Zygadlewicz

@endcomponent



