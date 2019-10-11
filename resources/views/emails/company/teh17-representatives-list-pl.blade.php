

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**W panelu Wystawcy jest dostępna opcja dodawania Przedstawicieli Wystawcy, którzy mają mieć wydrukowane identyfikatory i będą reprezentowali firmę na stoisku.**

** Prośba o dodanie przedstawicieli dzisiaj** gdyż najpóźniej we wtorek rano chcielibyśmy oddać pliki do druku! 

# Lista zdefiniowanych osób

@forelse($representatives as $rep)

	{{$rep->translate("[[fname]] [[lname]] [[position]]")}}

@empty

**Jeszcze nie zdefiniowano przedstawicieli**

@endforelse

@component('mail::button', ['url' => $accountUrl])
Dodaj / usuń Przedstawicieli 
@endcomponent

Przypominamy, że w ramach wykupionej przestrzeni wystawienniczej otrzymujesz maksymalnie 4 vouchery obiadowe w cenie stoiska i 1 kartę parkingową. **Jeśli Przedstawicieli jest więcej niź 4 - dokup proszę vouchery obiadowe** (Usługi dodatkowe.)

Pozdrawiamy,

Karolina Michalak

Jakub Przybylski

@endcomponent



