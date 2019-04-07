

@component('mail::message')


<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-bottom: 30px;"></a>

# Cześć, tu {{  array_get($companydata, "name") }}!

## 7 listopada będziemy na XV Targach eHandlu w Warszawie. Jeśli masz czas i chęci, chętnie porozmawiamy na miejscu przy naszym stoisku 


@component('mail::button', ['url' => $promolink])
Odbierz bezpłatną wejściówkę
@endcomponent


Targi eHandlu to również **3 sceny** prezentacyjne, blisko **130 Wystawców** oferujących produkty i usługi pomagające skutecznie sprzedawać w Internecie.

Wejście zarówno na EXPO jak i 3 sceny prezentacyjne jest bezpłatne.

Do zobaczenia, {{ array_get($companydata, "name") }} 

PS: Targi eHandlu odbędą się na **EXPO XXI (ul. Prądzyńskiego). Start 10:00.** 


@endcomponent



