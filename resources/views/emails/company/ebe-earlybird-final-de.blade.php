

@component('mail::message')

# Hi {{$profile->translate("[[fname]]")}},

Heute ab **12 Uhr** beginnt die Early-Bird-Verkaufsphase für die E-commerce Berlin 2020 Expo für die Aussteller der E-commerce Berlin 2019 Expo.
 
Der Kauf einer Standfläche im Early-Bird-Modus ist nur bis zum Ende des Monats möglich oder solange der Vorrat reicht. **Die Anzahl der Standflächen im Early-Bird-Zyklus ist begrenzt.** 

Hier kannst du dich mit dem Flächenplan vertraut machen (ab 12:00)

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe5earlybird1200"])
Hier Reservieren
@endcomponent

Mit freundlichen Grüßen,

E-commerce Berlin Expo

@endcomponent



