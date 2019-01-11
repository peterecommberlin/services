

@component('mail::message')

# Hallo {{$profile->translate("[[fname]]")}},

**In deinem Ausstellerdashboard hast du nun die Optionen, zusätzliche Sachen zu buchen.**

Die Möglichkeiten sehen wie folgt aus:

* LED-Bildschirm 50 Zoll (HDMI + USB)
* Flyerverteilung
* Sponsoring von Besuchertaschen
* Sponsoring von Liegestühlen
* Sponsoring der Besucherpässe

und standbaubezogen:

* Vollständiger Standbau mit vollem Branding der Rückwand, Theke, Broschürenhalter
* Einfacher Standbau mit einfachem Branding der Rückwand, Theke und Broschürenhalter
* Teppichbelag

Wir möchten ausdrücklich betonen, dass manche Leistungen an die Anzahl und eine bestimmte Frist verknüpft sind. Beim Standbau bemisst sich die Frist **bis zum kommenden Freitag, den 17.01.2019.**

Für mehr Details zu den einzelnen Angeboten drücke den Button unten.

@component('mail::button', ['url' => $accountUrl])
Zu meinem Account gelangen
@endcomponent


Jan Sobczak - Key Account Manager
E-commerce Berlin Expo
+49 30 2555 9875

@endcomponent



