

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**Jakie wrażenia po Targach?**

**Przygotowaliśmy ankietę**, dzięki której mamy nadzieję wygładzić ew. ostre krawędzie organizacyjne w przyszłości :)

Prośba o poświęcenie kilku minut i wypełnienie.

@component('mail::button', ['url' => "https://goo.gl/forms/R6OrYXvhPTGv4uUm1"])
Wypełnij ankietę
@endcomponent

[Na naszym profilu na Facebooku](https://www.facebook.com/pg/targiehandlu/photos/?tab=album&album_id=2631296346880355) wrzuciliśmy wybrane zdjęcia. **Zachęcamy do odnalezienia i otagowania siebie i znajomych.**

**Wszystkie zdjęcia w jakości HI-RES** mamy podzielone na konkretnych Wystawców i zostaną rozesłane jak tylko zbierzemy zadowalającą liczbę odpowiedzi na ankietę :)**

Pozdrawiam, Adam Zygadlewicz

@endcomponent



