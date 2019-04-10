

@component('mail::message')

# Cześć {{$p->translate("[[fname]]") }}!

Opublikowaliśmy pełną agendę **XVI Targów eHandlu w Krakowie**.

Przypominam, że wstęp na EXPO i PREZENTACJE jest bezpłatny - **bilet do druku** otrzymasz na 2-3 dni przed wydarzeniem.

... a wydarzenie odbędzie się dokładnie za tydzień - w środę - 17 kwietnia w EXPO Kraków (Galicyjska 9)


@component('mail::button', ['url' => $scheduleURl ])
	Agenda prezentacji
@endcomponent

## Aż 35 prelegentów i 4 sceny prezentacyjne

Wśród tematów, m.in.

Czy PWA to **zagłada aplikacji mobilnych**?

**Opakowania** w eHandlu - trendy i przyszłość

Jak **informacja produktowa** wpływa na wrażenia zakupowe?

Od ZERA do BEST-SELLERA, czyli jak skutecznie wprowadzić **private label na AMAZON**

Czego **haker** szuka w Twoim eSklepie?

Czy **dostawy i zwroty** w Twoim e-sklepie mogą być jeszcze prostsze?


Oprócz niesamowitej agendy zapraszamy do zapoznania się z ofertą ponad 130 Wystawców
[z ofertą ponad 130 Wystawców]({{ $exhibitorsURl }})

**Widzimy się? :)**

Pozdrawiam! 

Jan Cyprych


@endcomponent



