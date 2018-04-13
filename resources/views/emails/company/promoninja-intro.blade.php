

@component('mail::message')
 
# Dzień dobry, {{$profile->translate("[[fname]]")}},

** ...niektórzy Wystawcy zobaczyli podstronę dotyczącą konkursu i zaczęli działać. Lider - firma Delante - ma 124 punkty. Bardzo łatwo to pobić.**

Ale o co chodzi?

@component('mail::panel')

Niektóre nasze świadczenia nie są dostępne w regularnej sprzedaży. Uważamy, że powinny być dostępne dla firm, które chwalą się tym, że uczestniczą w Targach eHandlu i zapraszają swoich partnerów do odwiedziń na stoisku.

@endcomponent

# Nagrody 

**Szczegóły (np. ile minimalnie trzeba zdobyć punktów...) dostępna jest w Panelu Wystawcy (link na końcu wiadomości)**

## Prezentacja

20-minutowy slot prezentacyjny podczas wydarzenia. Twoja prezentacja zostanie dodana do oficjalnej agendy Targów eHandlu.

## Wywiad wideo z przedstawicielem firmy

Zostanie on przeprowadzony podczas wydarzenia, a następnie opublikowany na fanpage'u Targów eHandlu oraz portalu ehandelmag. Oczywiście zostanie też przekazany do dowolnego wykorzystania przez Wystawcę :)

## Dostęp do najtańszej puli sprzedaży na kolejne Targi

Kolejne Targi eHandlu już 7. listopada. Najbardziej zaangażowani Wystawcy dostaną informację apropos otwarcia sprzedaży wcześniej. Niższe ceny, lepszy wybór lokalizacji stoiska.

## Dostęp do listy zwiedzających i dodatkowy pakiet zaproszeń 

Otrzymasz 50 personalnych zaproszeń do wykorzystania w swoim Panelu Wystawcy.

## Wyróżnienie logotypu

Twój logotyp zostanie wyświetlony na oficjalnej stronie Targów eHandlu wśród wiodących firm z branży e-commerce.

## Dystrybucja ulotek na terenie Targów

Twoja firma będzie miała mozliwość dystrybuowania ulotek na terenie całej hali targowej. (*) Koszty produkcji, dostawy i wynajęcia hostess ponosi wystawca.

## Aplikacja do skanowania identyfikatorów Zwiedzająych, dane kontaktowe w excelu

Otrzymasz dostęp do aplikacji umożliwiającej skanowanie identyfikatorów zwiedzających. Każdy z przedstawicieli Twojej firmy będzie mógł zbierać dane o odwiedzających i eksportować wyniki do .xls lub .csv.


## Roll-up w strefie Business Lounge lub cateringu dla Zwiedzających

Twój firmowy roll-up znajdzie się w strefie networkingowej i gastronomicznej dla Wystawców.
Musisz zająć miejsce pomiędzy #1 a #8, minimum 20 punktów.

## Gościnny artykuł na branżowym portalu ehandelmag

Możliwość opublikowania autorskiego artykułu na portalu ehandelmag. Wpis będzie promowany na oficjalnych kanałach social media Targów eHandlu.


@component('mail::button', ['url' => $accountUrl])
Logowanie do Panelu Wystawcy 
@endcomponent

## Chcesz użyć własnych materiałów promocyjnych? 

Oto Twój link trackujący, wystarczy, że Twoje newslettery, stopki @, reklamy, posty w serwisach społecznościowych będą linkowały do Twojego profilu na Targi eHandlu za pomocą tego linka.

@component('mail::panel')


[{{ $trackingLink }}]({{ $trackingLink }}) 


@endcomponent


Pozdrowienia, Bartek Meller

@endcomponent



