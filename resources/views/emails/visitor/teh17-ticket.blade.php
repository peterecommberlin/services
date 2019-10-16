

@component('mail::message')

# Cześć {{$p->translate("[[fname]]") }} 

Twój bilet na 17 Targi eHandlu w Warszawie jest gotowy do pobrania i druku.

@component('mail::button', ['url' => $url])
Pobierz bilet
@endcomponent

{{$p->translate("[[fname]]") }}, na stronie z biletem znajdują się przyciski do pochwalenia się na Facebook, Twitter i Linkedin, że będziesz na Targach.
Być może Twoi znajomi jeszcze nie widzą o tym wydarzeniu a **interesują się ehandlem?**

Na stronie z biletem znajduje się także **szczegółowa agenda prezentacji na 4 scenach** (tak! ...będą aż 4 sceny!).

Pamiętaj, że **jeśli nie masz możliwości wydrukowania biletu** - NIE MA PROBLEMU! **Wydrukujemy go Tobie na miejscu**

Przypominamy, że Targi odbędą się **22 października (to wtorek!) w Warszawie** na EXPO XXI / Hala 1

Do zobaczenia! Katarzyna Wicher

@endcomponent







