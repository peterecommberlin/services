

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

**Przypominamy, że w panelu Wystawcy możesz rozszerzyć swoje zamówienie o dodatkowe usługi.**

Jeśli planujesz dokupienie czegoś z poniższej listy - prosimy o dokonanie wyboru przed weekendem. **Bardzo ułatwi nam to pracę...**

Lista aktualnych usług to:

* Dodatkowe vouchery cateringowe (poza maksymalnie 4, które są w cenie stoiska)
* Dodatkowa karty parkingowe (poza 1, która jest w cenie)
* Ekran LED 50 cali ze statywem
* Prawo do dystrybucji ulotek poza stoiskiem (np przy wejściu i w 2 strefach networkingu)
* Niezależne podłączenie prądu 3000W (zamiast standardowych 300W) jeśli planujesz wyposażenie stoiska inne niż 1-2 laptopy i TV


oraz 

* Kompleksowa zabudowa przestrzeni stoiska w wersji FULLPRINT
* Kompleksowa zabudowa przestrzeni stoiska w wersji OSB+logotyp
* Lada z nadrukiem
* Wykładzina
* Dodatkowe meble

Uwaga: Niektóre świadczenia są **ograniczone ilościowo** jak i **czasowo** (np zamówienie związane z zabudową tylko do 9 października)

Sprawdź szczegóły korzystając z przycisku poniżej (przejdź na podstronę "Usługi dodatkowe")

@component('mail::button', ['url' => $accountUrl])
Zaloguj się do Panelu Wystawcy 
@endcomponent

Pozdrawiam, Karolina Michalak

@endcomponent



