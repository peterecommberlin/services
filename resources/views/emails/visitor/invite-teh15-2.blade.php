

@component('mail::message')

# Cześć {{$p->translate("[[fname]]") }}!

Opublikowaliśmy agendę 2 scen **XV Targów eHandlu w Warszawie** - [agenda tutaj]({{ $scheduleURl }}).

Podobnie jak w poprzednich edycjach **wstęp** na EXPO i PREZENTACJE jest **bezpłatny** (wymagana rejestracja na stronie) i pojawienie się **7 listopada w EXPO XXI w Warszawie.**

**Uruchamiamy trzecią scenę!** na której wystąpią m.in. indaHash, Vue Storefront / Divante, Sempai, SMSAPI czy user.com. Będzie się działo!!!!

## Oprócz znakomitej agendy, ponad 130 Wystawców będzie coś jeszcze. Oferty Specjalne!

Od ponad tygodnia namawiamy czołowe polskie i europejskie firmy dostarczające rozwiązań dla sklepów internetowych do przygotowania czegoś co będzie dostępne tylko podczas dnia targowego....

## Wybrane oferty dostępne na Targach

@component('mail::panel')
Lead360: Przez 30 dni od Targów eHandlu promocja na aktywację Lead360. Odbierz promocyjny kupon na naszym stoisku i **oszczędź nawet 1451zł** na aktywacji usługi!
@endcomponent


@component('mail::panel')
click community: uzyskaj **bezpłatną poradę** z zakresu #SocialMedia! Możemy wspólnie przeanalizować Twoje kanały SM, podpowiedzieć Ci, jak usprawnić komunikację, zdradzić, co zrobić, by Twój Facebook sprzedawał lub jak robić skuteczny Social Employer Branding.(...)
@endcomponent


@component('mail::panel')
CzechLogistic: Klienci, którzy spotkają się z naszym zespołem na targach eHandlu w Warszawie otrzymają ofertę 1. **Bezpłatną obsługą zwrotów** - na jakikolwiek magazyn zagraniczny trafi twoja zwrotna przesyłka, otrzymasz ją bezpłatnie pod Twój adres w Polsce. 2. Niższymi cenami za przesyłki kurierskie.
@endcomponent


@component('mail::panel')
Espago dla gości targowych proponuje: **10% rabatu od cennika**, więcej szczegółów u naszych przedstawicieli w czasie trwania targów. 
@endcomponent


@component('mail::panel')
EUROCOMMERCE: Dla klientów, którzy rozpoczynają współpracę po kontakcie podczas targów eHandlu, **pierwszy miesiąc magazynowania gratis!**
@endcomponent

@component('mail::panel')
Sugester: Dla wszystkich nowych klientów z targów **zniżka 50% na pierwszy rok**. Oferta ważna do końca 2018 r.
@endcomponent

@component('mail::panel')
Trusted Shops: Wszyscy, którzy odwiedzą stoisko  na Targach E-handlu i zdecydują się na zakup usług w ciągu 2 tygodni od wydarzenia, otrzymają **15% rabatu w pierwszym roku umowy**
@endcomponent

**To tylko część ofert. Widzimy się?**

@component('mail::button', ['url' => $registerURl])
	Tak, chcę bezpłatny bilet
@endcomponent


Pozdrawiam! 

Adam Zygadlewicz, Targi eHandlu

<a href="{{$siteUrl}}"><img src="http://res.cloudinary.com/eventjuicer/image/upload/c_fit,w_650/v1523564269/welcome1.jpg" alt="miłe twarze cudownych Uczestników" style="margin: 10px auto;" /></a>


@endcomponent



