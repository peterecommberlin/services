

@component('mail::message')


<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-bottom: 30px;"></a>

# Cześć, tu {{  array_get($companydata, "name") }}!

## 8 listopada będziemy na XIII Targach eHandlu w Warszawie. Jeśli masz czas i chęci, chętnie porozmawiamy na miejscu przy naszym stoisku 


@component('mail::button', ['url' => $promolink])
Odbierz bezpłatną wejściówkę
@endcomponent



Targi eHandlu to również **3 sceny** prezentacyjne, blisko **140 Wystawców** oferujących produktu i usługi pomagające sprzedawać w Internecie


Do zobaczenia, {{ array_get($companydata, "name") }} 


PS: Targi ehandlu odbędą się na **EXPO XXI w Warszawie. Start 10:00.** 


@endcomponent



