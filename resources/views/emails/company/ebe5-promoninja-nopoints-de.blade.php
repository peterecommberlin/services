

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

wir haben festgestellt, dass Euer Unternehmen nicht bei unserem Ausstellerwettbewerb teilnimmt. 

Falls du eine Präsentation auf einer unserer 4 Bühnen haben möchtest oder extra Sichtbarkeit notwendig ist (Logo auf den Besucherbadges oder im Videointerview), dann ist der Wettbewerb der einfachste Weg zum Erfolg. 

Zur Zeit sind das die Top 3: Firma jeden liczba Punkte, firma dwa liczba Punkte, firma 3 liczba Punkte

Wie können wir dir helfen? 

1. Würdest du mit uns einen 10-minütigen Call machen? Dann erklären wir dir wie das Prozedere aussieht. Bitte benutze den Link unten und wähle den für dich besten Zeitpunkt. 

2. Unten wirst du einen Schnellstart-Guide finden (mit deinem personaliserten Link), und merken, wie einfach es ist am Wettbewerb teilzunehmen. Alternativ kannst du diese Nachricht an Euer PR-Team weiterleiten. 

Quickstart-Guide

> Klick hier, um den Post auf Facebook zu teilen
> Klick hier, um den Post auf LinkedIn zu teilen
> Klick hier, um den Post in deinem TT Account zu teilen
> Download einer fertigen ZIP-Datei mit einem E-Mail-Newsletter-Template. 

Jeder Klick auf den Link beschert dir einen Punkt und Extrasichtbarkeit - da der Verkehr zu deinem öffentlichen Profil weitergeleitet wird. 


Falls ihr Eure eigenen Promomaterialien benutzen wollt, dann könnt ihr das machen aber in Verbindung mit dem personalisierten Link. 
Benutze es beim Erstellen von Newslettern, E-Mail-Signaturen, Werbungen (Faceboook ads, Adwords, Soziale Medien) oder beim direkten Kontakt mit euren Kunden. 

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent


**  WICHTIG: Der Wettbewerb läuft bis zum 4.02.2020, 23:59 Uhr MEZ. **

# In deinem Ausstellerprofil wirst du 4 wichtige Sektionen finden in Bezug auf den Wettbewerb. 

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# RANKING

Das Ranking basiert auf den verarbeiteten Daten von Google Analytics.


## KRITERIEN

Jeder Preis ist an bestimmte Kriterien geknüpft: 

> eine bestimmte Anzahl an Punkten (gemessen an den Klicks des personalisierten Links) 
> Position im Ranking 

Du kannst deine Position im Ranking in Echtzeit beobachten, so dass du ggf. noch einen Einfluss auf das Resultat haben kannst. 

# PREISE 

## Exklusiv gebrandete Besucherbadges 

Besucherbadges mit dem Logo des Gewinners. Die Badges werden an alle Besucher der E-commerce Berlin Expo verteilt (7k+Besucher).

## Speaking Slot auf einer der Bühnen 

Die Präsentation kommt in die Agenda und wird in den öffentlichen Kanälen promotet als Teil der Agenda der Expo. 

## Videointerview 

Dein Unternehmen wird auf eurem Messestand während der Expo interviewed! Du bekommst die Promomaterialien und wir werden das Interview nach der Expo promoten. 


## Das Promoten Eures Logos auf unserer Website

Diese Preis führt dazu, dass Euer Logo auf unserer Website für die nächsten 11 Monate sichtbar sein wird - also bis zur Expo 2021. 

## Willst du deine eigenen Promomaterialien im Wettbewerb benutzen? Das ist perfekt, nur vergiss dabei das Integrieren des personalisierten Links nicht. 

## Jeder Klick auf den Link bringt dir einen Punkt. Nur seriöse Klicks werden im Ranking beachtet. 


@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Regards, 

{{$footer}}

@endcomponent

