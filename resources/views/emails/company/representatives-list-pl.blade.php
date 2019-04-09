

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**Przypominamy, że w panelu Wystawcy jest dostępna opcja dodawania Przedstawicieli Wystawcy, którzy mają mieć wydrukowane identyfikatory i będą na stoisku.**

** Deadline - DZISIAJ - 9 kwietnia - 17:00 czasu warszawskiego :) ** 

# Lista zdefiniowanych osób

@forelse($representatives as $rep)

	{{$rep->translate("[[fname]] [[lname]] [[position]]")}}

@empty

**Jeszcze nie zdefiniowano przedstawicieli**

@endforelse


@component('mail::button', ['url' => $accountUrl])
Dodaj / usuń Przedstawicieli 
@endcomponent


Przypominamy, że w ramach wykupionej przestrzeni wystawienniczej otrzymujesz 4 vouchery obiadowe i 1 kartę parkingową - chyba, że zamówiono dodatkowe. 

Pozdrawiamy,

Karolina Michalak
Jakub Przybylski

@endcomponent



