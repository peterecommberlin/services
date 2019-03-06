

@component('mail::message')

# Hi {{$profile->translate("[[fname]]")}},

Morgen ab **12 Uhr** beginnt die Early-Bird-Verkaufsphase für die E-commerce Berlin 2020 Expo für die Aussteller der E-commerce Berlin 2019 Expo.
 
Der Kauf einer Standfläche im Early-Bird-Modus ist nur bis zum Ende des Monats möglich oder solange der Vorrat reicht. Die Anzahl der Standflächen im Early-Bird-Zyklus ist **begrenzt.** 

Hier kannst du dich mit dem Flächenplan vertraut machen

@component('mail::button', ['url' => "https://res.cloudinary.com/ecommerceberlin/image/upload/v1551874462/ebe5_floorplan.png"])
Check the map here
@endcomponent

**Sie erhalten morgen um 11:30 Uhr einen gültigen Buchungslink**

Mit freundlichen Grüßen,

Lucas Zarna 

@endcomponent



