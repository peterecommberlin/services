

@component('mail::message')
 
# Hi {{ array_get($profile, "fname") }},

wir haben festgestellt, dass Euer Unternehmen nicht bei unserem Ausstellerwettbewerb teilnimmt. 

** Zur Zeit sind das die Top 3: A4G DSP (610 Punkte), knowhere (575 Punkte), hello.de AG (351 Punkte).**

Falls du eine **Präsentation** auf einer unserer 4 Bühnen haben möchtest oder extra Sichtbarkeit notwendig ist (**Logo auf den Besucherbadges** oder im **Videointerview**), dann ist der Wettbewerb der einfachste Weg zum Erfolg. 

## Wie können wir dir helfen? 

1. Würdest du mit uns einen 10-minütigen Call machen? Dann erklären wir dir wie das Prozedere aussieht. Bitte [benutze den Link hier]({!! $calendar !!}) und wähle den für dich besten Zeitpunkt. 

2. Unten wirst du einen Schnellstart-Guide finden (mit deinem personaliserten Link), und merken, wie einfach es ist am Wettbewerb teilzunehmen. 

## Quickstart-Guide

a) [Download einer fertigen ZIP-Datei mit einem E-Mail-Newsletter-Template.]({!! array_get($newsletter, "zip") !!})

b) [Klick hier, um den Post auf LinkedIn zu teilen]({!! array_get($sharers, "linkedin") !!})

c) [Klick hier, um den Post auf Facebook zu teilen]({!! array_get($sharers, "facebook") !!})

d) [Klick hier, um den Post in deinem TT Account zu teilen]({!! array_get($sharers, "twitter") !!})

** Alternativ kannst du diese Nachricht an Euer PR-Team weiterleiten. **

Jeder Klick auf den Link beschert dir einen Punkt und Extrasichtbarkeit - da der **Verkehr zu deinem öffentlichen Profil** weitergeleitet wird. 

Falls ihr Eure **eigenen Promomaterialien benutzen wollt**, dann könnt ihr das machen aber in Verbindung **mit dem personalisierten Link. **

** Benutze es beim Erstellen von Newslettern, E-Mail-Signaturen, Werbungen (Faceboook ads, Adwords, Soziale Medien) oder beim direkten Kontakt mit euren Kunden. **

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

**  WICHTIG: Der Wettbewerb läuft bis zum 4.02.2020, 23:59 Uhr MEZ. **

## Mehr Infos zum Thema

In deinem Ausstellerprofil wirst du 4 wichtige Sektionen finden in Bezug auf den Wettbewerb. 

## RANKING

Das Ranking basiert auf den verarbeiteten Daten von Google Analytics.

## KRITERIEN

Jeder Preis ist an bestimmte Kriterien geknüpft: 

* eine bestimmte Anzahl an Punkten (gemessen an den Klicks des personalisierten Links) 
* Position im Ranking 

Du kannst deine Position im Ranking in Echtzeit beobachten, so dass du ggf. noch einen Einfluss auf das Resultat haben kannst. 

## PREISE 

**Exklusiv gebrandete Besucherbadges **

Besucherbadges mit dem Logo des Gewinners. Die Badges werden an alle Besucher der E-commerce Berlin Expo verteilt (7k+Besucher).

**Speaking Slot auf einer der Bühnen **

Die Präsentation kommt in die Agenda und wird in den öffentlichen Kanälen promotet als Teil der Agenda der Expo. 

**Videointerview**

Dein Unternehmen wird auf eurem Messestand während der Expo interviewed! Du bekommst die Promomaterialien und wir werden das Interview nach der Expo promoten. 

**Das Promoten Eures Logos auf unserer Website**

Diese Preis führt dazu, dass Euer Logo auf unserer Website für die nächsten 11 Monate sichtbar sein wird - also bis zur Expo 2021. 

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent


## Willst du deine eigenen Promomaterialien im Wettbewerb benutzen? Das ist perfekt, nur vergiss dabei das Integrieren des personalisierten Links nicht. 

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

## Jeder Klick auf den Link bringt dir einen Punkt. Nur seriöse Klicks werden im Ranking beachtet. 


Regards, 

{{$footer}}

@endcomponent

