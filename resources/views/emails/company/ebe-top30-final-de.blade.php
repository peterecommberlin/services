

@component('mail::message')
 
# Halo {{$profile->translate("[[fname]]")}}!

**Heute**, **um 10 Uhr** beginnt die Early-Bird-Phase für den Kauf von Standflächen für die **E-commerce Berlin Expo 2020** für diejenigen Aussteller, die im Wettbewerb vor der E-commerce Berlin 2019 Expo im Ranking unter den TOP 30 gelandet sind. 

Das Buchen wird **bis 11:30** Uhr möglich sein (um 12 Uhr beginnt der Verkauf für die Aussteller, die nicht in den TOP 30 dabei gewesen sind). 

**Um 10 Uhr musst du auf den o.g. Button klicken. ** 

Das Anschauen und reservieren wird nicht über die Homepage möglich sein. 

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe5top30presales"])
Hier Reservieren
@endcomponent

Lieben Gruß,

E-commerce Berlin Expo Team

@endcomponent

