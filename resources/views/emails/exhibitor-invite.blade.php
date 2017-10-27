

@component('mail::message')

<img src="{{$imageEnc}}" alt="" style="margin-bottom: 30px;">


# Cześć, tu {{ array_get($participant, "fields.cname2") }}!

## 8 listopada będziemy na XIII Targach eHandlu w Warszawie. Jeśli masz czas i chęci, chętnie porozmawiamy na miejscu przy naszym stoisku {{array_get($participant, "fields.booth")}}


@component('mail::button', ['url' => $promolink])
Odbierz bezpłatną wejściówkę
@endcomponent




Targi eHandlu to również **3 sceny** prezentacyjne, blisko **140 Wystawców** oferujących produktu i usługi pomagające sprzedawać w Internecie


Do zobaczenia, {{ array_get($participant, "fields.cname2") }} 


PS: Targi ehandlu odbędą się na **EXPO XXI w Warszawie. Start 10:00.** 

* [https://targiehandlu.pl]({{$promolink}}) 
* https://www.facebook.com/targi.ehandlu/
* https://twitter.com/targiehandlu/

@endcomponent



