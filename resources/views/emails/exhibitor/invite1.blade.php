

@component('mail::message')


<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-bottom: 30px;"></a>

# Cześć, tu {{  array_get($companydata, "name") }}!

## 25 kwietnia będziemy na XIV Targach eHandlu w Krakowie. Jeśli masz czas i chęci, chętnie porozmawiamy na miejscu przy naszym stoisku 


@component('mail::button', ['url' => $promolink])
Odbierz bezpłatną wejściówkę
@endcomponent


Targi eHandlu to również **3 sceny** prezentacyjne, blisko **140 Wystawców** oferujących produkty i usługi pomagające skutecznie sprzedawać w Internecie.

Wejście zarówno na EXPO jak i 3 sceny prezentacyjne jest bezpłatne.


Do zobaczenia, {{ array_get($companydata, "name") }} 


PS: Targi eHandlu odbędą się na **EXPO Kraków (ul. Galicyjska). Start 10:00.** 


@endcomponent



