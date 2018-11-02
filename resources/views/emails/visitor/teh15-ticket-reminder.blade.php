

@component('mail::message')

# Cześć {{$p->translate("[[fname]]") }} 

Twój bilet na XV Targi eHandlu jest gotowy do pobrania i druku.

@component('mail::button', ['url' => $url])
Pobierz bilet
@endcomponent

{{$p->translate("[[fname]]") }}, na stronie z biletem znajdują się przyciski do pochwalenia się na Facebook, Twitter i Linkedin, że będziesz na Targach.
Być może Twoi znajomi jeszcze nie widzą o tym wydarzeniu a **interesują się ehandlem?**

Na stronie z biletem znajduje się także **szczegółowa agenda prezentacji na 3 scenach** (tak! ...będą aż 3 sceny!).

Pamiętaj, że **jeśli nie masz możliwości wydrukowania biletu** - NIE MA PROBLEMU! **Wydrukujemy go Tobie na miejscu**

Przypominamy, że Targi odbędą się **7 listopada (to środa!) w Warszawie**

Tym razem spotykamy się w **HALI 3  EXPO XXI** (zamiast Hali 4 jak w poprzednich latach)

Do zobaczenia! Adam Zygadlewicz

@endcomponent







