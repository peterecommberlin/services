

@component('mail::message')

Hallo {{$profile->translate("[[fname]]")}},

euer Standardpaket beinhaltet folgendes Equipment für euren Stand auf der Expo:

* Startup, Standard, Hot & SuperHot Fläche (9sqm) - 4 Stühle & 2 Stehtische (Ohne Rückwand, ohne Teppich)
* Grand Fläche (18 sqm) - 6 Stühle & 2 Stehtische (Ohne Rückwand, ohne Teppich)

Weitere Dienste können auf eurem Ausstellerpanel erworben werden **WICHTIG: Erwerbsfrist 21. Januar 2019**

Liste der verfügbaren Dienste:

* Erlaubnis zur Verteilung von Broschüren/Flyern durch Hostessen
* Exklusives Sponsern von Besucher Willkommenstaschen
* Exklusives Sponsern von Besucher Namenschildern
* 20x Logo auf Sitzen in der Networking Zone

Weitere Standdienste:

* Vollständiger Stand mit bedruckter Rückwand, Tresen, Magazinständer
* Vollständiger Stand mit OSB Rückwand und Logo

Weitere Dienste **WICHTIG: Erwerbsfrist 31. Januar 2019**

* 50 Zoll LED Monitor (HDMI + USB)
* Teppich
* Magazinständer

Einige Dienste sind aufgrund der hohen Nachfrage nur begrenzt verfügbar. Wir raten daher schnellstmöglich weitere Dienste anzufordern.

@component('mail::button', ['url' => $accountUrl])
Zu meinem Account gelangen
@endcomponent

Jan Sobczak - Key Account Manager

E-commerce Berlin Expo

+49 30 2555 9875

@endcomponent



