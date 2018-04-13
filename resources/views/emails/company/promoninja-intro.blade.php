

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**Najbardziej zaangażowani Wystawcy zobaczyli już stronę dotyczącą konkursu i zaczęli informowanie. Lider - firma Delante - ma 124 punkty. Nic straconego, bardzo łatwo to pobić.**

Ale o co chodzi?

@component('mail::panel')

Niektóre nasze świadczenia nie są dostępne w regularnej sprzedaży. Uważamy, że powinny być dostępne dla firm, które chwalą się tym, że uczestniczą w Targach eHandlu i zapraszają swoich Klientów i Partnerów do odwiedzenia ich stoiska.

@endcomponent

# Wybrane nagrody

**Kompletna lista oraz warunki przyznania dostępne w Panelu Wystawcy (link na końcu wiadomości)**

## Prezentacja na Głównej Scenie

15-minutowy slot prezentacyjny podczas wydarzenia. Twoja prezentacja zostanie dodana do oficjalnej agendy Targów eHandlu.

## Wywiad wideo z przedstawicielem firmy

Zostanie on przeprowadzony podczas wydarzenia, a następnie opublikowany na fanpage'u Targów eHandlu oraz portalu ehandelmag. Oczywiście zostanie też przekazany do dowolnego wykorzystania przez Wystawcę :)

## Dostęp do najtańszej puli sprzedaży na kolejne Targi

Kolejne Targi eHandlu już 7. listopada. Najbardziej zaangażowani Wystawcy dostaną informację apropos otwarcia sprzedaży wcześniej. Niższe ceny, lepszy wybór lokalizacji stoiska.

## Wyróżnienie logotypu

Twój logotyp zostanie wyświetlony na oficjalnej stronie Targów eHandlu wśród wiodących firm z branży e-commerce.

## Aplikacja do skanowania identyfikatorów Zwiedzająych i dane kontaktowe w excelu

Otrzymasz dostęp do aplikacji umożliwiającej skanowanie identyfikatorów zwiedzających. Każdy z przedstawicieli Twojej firmy będzie mógł zbierać dane o odwiedzających i eksportować wyniki do .xls lub .csv.

## Roll-up w strefie Business Lounge lub cateringu dla Zwiedzających

Twój firmowy roll-up znajdzie się w strefie networkingowej i gastronomicznej dla Wystawców.
Musisz zająć miejsce pomiędzy #1 a #8, minimum 20 punktów.


@component('mail::button', ['url' => $accountUrl])
Zaloguj się do Panelu Wystawcy 
@endcomponent

## Chcesz użyć własnych materiałów promocyjnych? 

Oto Twój link trackujący! Wystarczy, że Twoje newslettery, stopki @, reklamy, posty w serwisach społecznościowych będą linkowały do Twojego profilu na stronie Targów eHandlu za pomocą poniższego linka.

@component('mail::panel')


[{{ $trackingLink }}]({{ $trackingLink }}) 


@endcomponent

Pozdrawiam, Bartek Meller

@endcomponent



