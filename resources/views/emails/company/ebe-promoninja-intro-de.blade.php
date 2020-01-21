

@component('mail::message')
 
Hallo {{$profile->translate("[[fname]]")}},

**Wir haben einen Wettbewerb im Ausstellerpanel aktiviert. **

Was verbirgt sich dahinter?

@component('mail::panel')

Wir haben zusätzliche Dienste für Aussteller, welche ihre Anwesenheit auf der diesjährigen Expo promoten. 

Auf unserer Expo sollen nicht nur neue Kunden getroffen werden, sondern auch existierende Beziehungen gestärkt werden. 

Der Marktwert unserer angebotenen Dienste in diesem Wettbewerb betragen mehr als 25.000,-€.

@endcomponent

Du kannst Punkte sammeln, indem du die Anwesenheit deines Unternehmens auf der Expo promotest. Jeder Klick ergibt einen Punkt.

Finde unten deinen persönlich angefertigten Link. Nutze diesen Link für Newsletter, E-Mails, Social Media Kanäle oder bei direkten Benachrichtigungen an Kunden. 

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

**WICHTIG: Der Wettbewerb läuft bis zum 4. Februar 11:59PM CET.**

# In deinem Ausstellerpanel findest du 4 wichtige Bereiche bezüglich des Wettbewerbs.

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# Platzierung

Die Platzierung wird durch Google Analytics generiert. Die Updates zu den Platzierungen werden alle 24 Stunden aktualisiert.  

## Preise

Alle Preise können nur mit der Erfüllung der Konditionen erhalten werden.

* Minimale Anzahl der Punkte (= Anzahl der Klicks auf deinen persönlich erstellten Link)
* Position im Ranking

Ob dein Unternehmen alle Konditionen erfüllt, findest du in der Preisliste im Ausstellerpanel. Erinnerung: Platzierungen können sich jeden Tag aufs Neue ändern. 

## EMAIL VORLAGEN

2 E-Mail Vorlagen (deutsch/englisch), welche deine Anwesenheit auf der Expo promoten. Du kannst diese als HTML Datei oder Zip Datei herunterladen oder zu Newsletter2go / Mailchimp-ähnliche Softwaren exportieren. 

## PROMO MATERIALIEN

3 Links, welche du mit verschiedenen Grafiken teilen kannst. 

* Euer Logo auf unseren Hintergrund mit Einladung zum Event auf deutsch
* ... auf englisch
* Persönliches Design ( Hierzu musst du unter ‘Firma’ eine URL angeben). 

Jeder Link kann kopiert werden und via Messenger oder in deinem eigenen Newsletter verwendet werden. 


@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# Ausgewählte Preise

## Exklusives Branding der Besucherpässe

Exklusives Branding der Besucherpässe mit dem Logo des Gewinners. Die Badges werden an die Besucher (7000+) der E-commerce Berlin Expo 2020 verteilt. 

## Präsentation

Eine 30-minütige Präsentation auf einen der vier Bühnen. Eure Präsentation wird in die offizielle E-commerce Berlin Expo 2019 Agenda mit aufgenommen.

## Video Interview

Ein Video Interview wird mit einem Vertreter eurer Firma auf der Expo durchgeführt. Das Video Interview wird auf dem EBE Youtube Kanal sowie sämtlichen Social Media Kanälen veröffentlicht.


Du möchtest dein eigenes Promomaterial nutzen? Super! Nutze stets den persönlich angefertigten Link! 

## Jeder Klick auf den personalisierten Link, der zur Website der E-commerce Berlin Expo führt, bringt einen Punkt. 
Wir zählen nur die seriösen Stimmen. Das Registrieren auf der Website bringt keinen Punkt!

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Regards,

E-commerce Berlin Expo

@endcomponent

