

@component('mail::message')


<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-bottom: 30px;"></a>

# Cześć, tu {{  array_get($companydata, "name") }}!

## 17 kwietnia będziemy na XVI Targach eHandlu w Krakowie. Jeśli masz czas i chęci, chętnie porozmawiamy na miejscu przy naszym stoisku 


@component('mail::button', ['url' => $promolink])
Odbierz bezpłatną wejściówkę
@endcomponent


Najbliższe Targi eHandlu to również **aż 4 sceny** prezentacyjne, blisko **130 Wystawców** oferujących produkty i usługi pomagające skutecznie sprzedawać w Internecie.

Wejście zarówno na EXPO jak i sceny prezentacyjne jest bezpłatne.

Do zobaczenia, {{ array_get($companydata, "name") }} 

PS: Targi eHandlu odbędą się na **EXPO Kraków (ul. Galicyjska). Start 10:00.** 


@endcomponent



