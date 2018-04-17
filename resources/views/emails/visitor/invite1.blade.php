

@component('mail::message')

<a href="{{$siteUrl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1523951554/og_teh_default.png" style="margin: 10px auto; max-width: 650px;" alt="logotyp Targów eHandlu" /></a>

# Cześć {{$p->translate("[[fname]]") }}!

Każdego roku cyfrowa gospodarka a w szczególności branża związana z handlem online ustala **nowe zasady gry**.  Jeśli chcemy działać skutecznie, musimy zdobywać **aktualną wiedzę i wykorzystywać trendy.**

**{{$p->translate("[[fname]]") }}, zapraszam Cię** do przyjścia na XIV Targi eHandlu. Najbliższa edycja odbędzie się **25 kwietnia w Krakowie (Expo Kraków, ul. Galicyjska)**. 

Będziesz? Widzimy się? Jeśli tak to...

@component('mail::button', ['url' => $registerURl])
Zarejestruj się teraz
@endcomponent

**Jeśli jeszcze nie wiesz to może Cię przekonamy? :)**

<a href="{{$siteUrl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1523564269/welcome1.jpg" alt="miłe twarze cudownych Uczestników" style="max-width: 650px; margin: 10px auto;" /></a>


# Będzie jak zwykle będzie bardzo merytorycznie i na czasie. Tematy dla zaczynających jak i branżowych "wyjadaczy". Próbka? 

## RODO w e-commerce: jak pozbyć się check-boxów z WWW Twojego sklepu?

> ...RODO możecie w swoich e-sklepach wykorzystać do pewnych **ułatwień**. Dowiesz się tego, jak pozbyć się check-boxów pod formularzem kontaktowym, pod formularzem zamówienia oraz przy zapisach na newsletter

## Amazon – szanse i ryzyka na podstawie case study StukPuk.pl i ekspansji na rynki zagraniczne

> Z prezentacji dowiesz się: jakie są **zalety i zagrożenia** z jakimi spotkaliśmy się my oraz wielu innych przedsiębiorców w Polsce, z czym wiąże się sprzedaż na Amazonie pod kątem **księgowym oraz VAT**, obsługi klienta oraz zarządzania ofertą produktową na wielu rynkach

## Kupowanie w mobile'u – co musisz wiedzieć o zwyczajach zakupowych Twoich użytkowników

> O mobile first ("wpierw dla komórek") powiedziano i napisano bardzo wiele. Dzięki prezentacji łatwiej będzie Tobie zdecydować, o tym: w które narzędzia inwestować, które obszary rozwijać, jak prowadzić komunikację, aby była jak najbardziej **efektywna sprzedażowo**.

[Lista wszystkich 22 wystąpień]({{$scheduleURl}})

@component('mail::button', ['url' => $registerURl])
Szybka rejestracja
@endcomponent


# Targi eHandlu to przede wszystkim Praktycy, którzy "zjedli zęby" na swoim własnym biznesie

<a href="{{$presentersURl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1523951060/teh14_prelegenci.jpg" alt="miłe twarze cudownych Prelegentów" style="margin: 10px auto;" /></a>

## Maciej Ziemczonek,Performance &amp; Outbound Marketing Manager @ Domodi.pl

> Jedna z czołowych postaci polskiego e-commerce. Pierwsze korki stawiał już **w 2004 roku w Militaria.pl**. Kolejnymi przystankami na jego zawodowej ścieżce były **Ceneo.pl i Pixers**. Obecnie gra pierwsze skrzypce w Domodi.pl - jednym z najpopularniejszych serwisów e-handlu w kraju. Już 25 kwietnia w Krakowie podzieli się swoją wiedzą oparta na ponad **14-letnim doświadczeniu.**

## Mateusz Czech, Customer Success Manager @ Brand 24 S.A.

> Młody i ambitny. Mimo młodego wieku sprawnie porusza się w obszarze online marketingu.  Specjalizuje się w tworzeniu **botów na Messengera**. Podczas swojej prelekcji opowie dlaczego booty nie powinny być utożsamiane z narzędziami do rozsyłania spamu i jak je wykorzystać do rozwoju swojego e-biznesu.

## Tomasz Jankowski, Owner @ stukpuk.pl

> Właściciel stukpuk.pl - jednego z **najprężniej działających e-sklepów budowlanych** w Polsce. Kilka lat temu śmiałym krokiem wszedł na Amazona osiągając globalny sukces. Na bazie swoich doświadczeń stworzył rozwiązanie saas o nazwie Expandica, które pomaga polskim e-handlowcom w ekspansji międzynarodowej. Chcesz dowiedzieć się w jaki sposób wyjść ze swoim e-biznesem poza granice kraju? Tomasz służy pomocą!

## Łukasz Chwiszczuk,Head of Digital Performance @ MediaGroup

> Pierwsze kroki w e-commerce stawiał **w 2008 roku**. Współpracował z takimi brandami jak **Volvo, mBank, PZU czy BZ WBK**. Doświadczony mówca goszczący na największych konferencjach branżowych w kraju. Ekspert w zakresie **SEM i analityki webowej**. O **Google Adwords** i Analitycs wie niemal wszystko. Jego ogromna wiedza na wyciągniecie ręki - już 25 kwietnia w Krakowie.

[Lista wszystkich Prelegentów]({{ $presentersURl }})

# XIV Targi eHandlu to unikatowa oferta

Ponad 130 Wystawców - Dostawców usług i produktów, dzięki którym możesz wnieść handel internetowy na najwyższy światowy poziom

Ponad 22 Prelegentów, którzy mają za sobą realne dokonania i osiągnięcia

Formuła open space, realna wartość

Olbrzymia przestrzeń do poznania nowych osób, wymiany doświadczeń 

Możliwość poznania całej panoramy rozwiązań w ehandlu w zaledwie kilka godzin!

Specjalne oferty Wystawców (dłuższe okresy testowe, niższe prowizje)

# Targi eHandlu to również ...Targi! Ta edycja jest rekordowa!

<a href="{{$exhibitorsURl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1523952361/teh14_debut.png" alt="marki wystawcy, debiuty" style="max-width: 650px; margin: 10px auto;" /></a>

[Lista wszystkich Wystawców]({{ $exhibitorsURl }})

@component('mail::button', ['url' => $registerURl])
Rejestracja Zwiedzającego
@endcomponent

Masz pytania? Odpowiedz na tę wiadomość - odpowiem i ja :)

Roman Turaj, Targi eHandlu


@endcomponent



