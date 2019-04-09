

@component('mail::message')

# Odbierz bezpłatną wejściówkę na największe targi przeznaczone dla sprzedających w Internecie w tej części Europy. 

**34 Prelegentów, ponad 130 Wystawców, ponad 3000 Uczestników - już 17 kwietnia w Krakowie**

Nadchodząca edycja będzie pod wieloma względami rekordowa. Do dyspozycji uczestników będą aż **4 sceny, na których swoją wiedzę i doświadczenie zaprezentuje 34 Praktyków związanych z e-handlem**.

@component('mail::panel')

Sprawny Marketing będzie również obecny. Zapraszamy na stoisko B2.6!

@endcomponent

@component('mail::button', ['url' => $presentersURl])
	Zapisz się na bezpłatny bilet
@endcomponent

<a href="{{$presentersURl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/c_fit,w_650/v1554271344/prelegenci2.jpg" style="max-width: 600px; margin: 20px 0;" alt="" /></a>

Na scenach wystąpią przedstawiciele takich firm jak: 

Gonito, eStrategie.pl, DS Smith Packaging, Trol InterMedia / 2ClickShop, Blue Media, AtomStore, Thulium, **eDrone**, AppChance, **Promotraffic**, Tomasz Wieliczko, grzywnowicz.pl, TestArmy CyberForces, www.setup.pl, Adequate, **GetResponse**, DevaGroup, Senuto, **Traffic Trends**, Antalis Poland, Dreamcommece S.A./**Shoper** , Email Partners, Infobip, Global4Net, Delante, **Sendit S.A.**, Emaillabs, e-point SA, SaveCart Sp. z o.o., Kancelaria Radcy Prawnego Marek Wiński , Legal Geek - firma prawnicza, Fifny, **BOLD/Strix**, **Sempai.**

@component('mail::button', ['url' => $registerURl])
	Bezpłatna rejestracja
@endcomponent

Oto lista tematów, które szczególnie mogą Cię zainteresować.

**Dlaczego wierzymy w kliknięcia?**

Czy śledzenie konwersji po kliknięciu w reklamę ma sens? Dlaczego nie ufamy konwersjom po wyświetleniu? Czy modelowanie atrybucji da odpowiedź na pytanie o wartość kampanii? 

**Od ZERA do BEST-SELLERA, czyli jak skutecznie wprowadzić private label na AMAZON**

Jak zorientować się czy Amazon jest odpowiednią platformą dla naszych produktów? Dlaczego przygotowanie sprzedaży jest zawsze ważniejsze od samej sprzedaży? Jak sprawić, żeby niewidoczna marka stała się liderem segmentu?

**10 praktycznych elementów audytu SEO na bazie case audytu silnika Shoper.pl i nie tylko**

Podczas prezentacji mieszanka: najbardziej skuteczne, skalowalne i nadające się do realnego wprowadzenia wnioski. Do tego dodaj pokazanie najlepszych profesjonalnych narzędzi i konkretne przykłady w oparciu o case studies, czyli ponad 1000 wykonanych przez nas analiz w tym audyt silnika Shoper.pl, na którym sklepy liczymy w tysiącach.

**Jak Progressive Web App zmienia zasady gry w ecommerce?**

Opis zalet technologii Progressive Web App oraz tego jak ta technologia wpływa na sposób odbioru treści przez użytkowników. Wady i zalety wdrożeń PWA, przykłady największych wdrożeń, omówienie zasad działania technologii oraz jej przewag nad tradycyjnym modelem wyświetlania treści.


@component('mail::button', ['url' => $registerURl])
	Chcę bezpłatny bilet
@endcomponent

Targi eHandlu to także Targi! Przez 7 godzin zwiedzania możesz poznać praktycznie całą, kluczową, panoramę rozwiązań wspierających skuteczną sprzedaż online :) 
Oto [lista wszystkich Wystawców]({{ $exhibitorsURl }})

**Widzimy się w Krakowie? :)**

Do zobaczenia! 

Jan Cyprych, Targi eHandlu


<a href="{{$siteUrl}}"><img src="http://res.cloudinary.com/eventjuicer/image/upload/c_fit,w_650/v1523564269/welcome1.jpg" alt="miłe twarze cudownych Uczestników" style="margin: 10px auto;" /></a>


@endcomponent



