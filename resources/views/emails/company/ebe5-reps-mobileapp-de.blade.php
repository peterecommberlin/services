

@component('mail::message')

# Hi  {{ array_get($profile, "fname") }},

Wollt ihr eure Leads, die auch am Stand besuchen scannen und somit ihre Kontaktdaten erhalten?

Wir haben dafür eine App.

# Download der App

## Android Benutzer

Suche nach der [E-commerce Berlin Exhibitor App im Playstore](https://play.google.com/store/apps/details?id=com.eventjuicer.ebe.exhibitors). Danach weiter zur Authenthication – Infos sind unten zu finden

## IOS Benutzer

(es ist ein bisschen komplizierter)

Öffne den App Store und suche nach [Expo Client](https://apps.apple.com/us/app/expo-client/id982107779) und installiere die App

Gehe zum Browser und füge diese URL ein: [expo.io/@eventjuicer/ebe-exhibitor](https://expo.io/@eventjuicer/ebe-exhibitor) und scanne den QR-Code mit deiner Kamera – du wirst automatisch weitergeleitet. Sollten damit Probleme entstehen, dann kannst du einen Link per E-Mail oder Textnachricht anfordern.

# Authentifizierung

Öffne die App. Click auf das Benutzericon. Suche nach deinem Firmennamen **{{ array_get($company, "name") }}** und füge das Passwort ein, welches unten zu sehen ist:

@component('mail::panel')

**{{ array_get($company, "password") }}**

@endcomponent

# Benutzung

Es gibt zwei Hauptfunktionen: Das Scannen und die gescannten Leads

Im Minutentakt werden wir versuchen deine Scans mit unserem Server zu synchornisieren.

Die gesamte Liste deiner Scanns, von jedem deiner Kollegen, die diese App genutzt haben, werden in eurem Ausstellerkonto unter „Scans” wiederzufinden sein. Diese kann man dann in eine .xlsx. Datei exportieren.

@component('mail::panel')

Wichtige Information: Die App ist **„so wie sie ist”** und wir werden nicht die Möglichkeit haben, am Aufbau- oder Eventtag Hilfe leisten zu können. Wir haben unser Bestes gegeben und es etliche Male getestet.

@endcomponent

Beste Grüße,

{{$footer}}

@endcomponent