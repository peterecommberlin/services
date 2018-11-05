

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

# Czy zapraszasz zarejestrowanych uczestników na spotkanie na Twoim stoisku? Na ten moment nasz system wysłał ponad 500 zaproszeń... jak na 130 Wystawców to niewiele!

Przypominamy, że w Panelu Wystawcy możesz przeglądać i zapraszać zarejestrowanych Uczestników. **Po akceptacji spotkania otrzymujesz pełne dane kontaktowe.**

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do swojego konta
@endcomponent

# Jak to działa...

Na start masz 5 "testowych" zaproszeń

Jeśli w Rankingu Konkursu dla Wystawców masz minimum 20 punktów otrzymujesz MEGA PAKIET dodatkowych 50 zaproszeń (sumarycznie masz ich zatem 55)

Za każde 5 punktów w rankingu otrzymujesz dodatkowe zaproszenie

(Lider rankingu ma do wykorzystania ponad 300 zaproszeń !!!)

# Jak to działa od strony Zwiedzającego...

Zaproszenie są grupowane i wysyłane raz dziennie. Zwiedzający może zaakceptować lub odrzucić zaproszenie. 

W momencie akceptacji **Wystawca otrzymuje pełne dane kontaktowe do Zwiedzającgo** i może umówić się na spotkanie na stoisku.

# Przypomnienie zasad Konkursu

Wyzwanie polega na posługiwaniu się ** "specjalnym linkiem zliczającym punkty"** lub indywidualnymi materiałami promocyjnymi, które przygotowaliśmy i które już zawierają w sobie ten link.

Oto Twój **link trackujący!** Wystarczy, że Twoje newslettery, stopki @, reklamy, posty w serwisach społecznościowych będą linkowały do Twojego profilu na stronie Targów eHandlu za pomocą poniższego linka i bierzesz udział w Wyzwaniu.

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

# W Panelu Wystawcy czekają na Ciebie 4 ważne strony 

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do Panelu Wystawcy 
@endcomponent

# RANKING

Ranking tworzony jest **z opóźnieniem ok 24h** na podstawie danych z Google Analytics.
Codziennie będziesz mógł zobaczyć jaki jest wynik Twoich i innych Wystawców działań z dnia poprzedniego.

## NAGRODY

Każda nagroda ma warunki jej przyznania: 

* co do minimalnej liczby punktów 
* co do pozycji w rankingu. Przy każdej pozycji nagrody widzisz czy biorąc pod uwagi stan punktów z dnia poprzedniego miał(a)byś ją przyznaną.

## SZABLONY NEWSLETTERA

2 szablony (polski i angielski), które informują o tym, że Twoja firma będzie na Targach eHandlu. Szablony mają link, który prowadzi do Twojego profilu i zlicza punkty.
Każdy newsletter możesz pobrać jako **paczkę ZIP i wczytać do programów typu Freshmail, GetResponse, Mailchimp**...

## MATERIAŁY PROMOCYJNE

To 3 oddzielne linki, które możesz udostępniać na serwisach społecznościowych. każdy z nich generuje inną grafikę jako podgląd (2 z Twoim logotypem... i jedna to Twoja własna kreacja jeśli podano URL do niej w Danych firmy).

Każdy z linków do grafiki możesz skopiować do schowka i wysłać via @, messenger, dodać do własnego newslettera.

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do Panelu Wystawcy 
@endcomponent


Regards, 

Marta Zaczyk
Jakub Przybylski
Jan Selga
Adam Zygadlewicz

@endcomponent

