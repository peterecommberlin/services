

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

wir haben festgestellt, dass Euer Unternehmen nicht bei unserem Ausstellerwettbewerb teilnimmt. 

# WORUM GEHT ES BEI DIESEM WETTBEWERB? 
**Jeder Aussteller hat einen speziellen Link bekommen, den man in den sozialen Medien teilen kann, der zu Verkehr auf der EBE Website führt.** 
Jeder Klick kommend von dem Link bringt einen Punkt und führt zur Extrasichtbarkeit - da der Verkehr auch zu Eurem öffentlichen Ausstellerprofil führt. 
Nur seriöse Klicks werden bei uns zugelassen (in Bezug auf die Daten, die Google Analytics verarbeitet). 

Das registrieren auf der Homepage führt zu keinem Punktgewinn. 


@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent


*Der Wettbewerb dauert bis zum 4.02.2020 23:59 Uhr MEZ.*


# Warum solltest du an diesem Wettbewerb teilnehmen (kostenlos)?
Lange Rede kurzer Sinn: Größere Sichtbarkeit und unglaubliche Preise. 


*Apropo Preise:* 
* Exklusiv gebrandete Besucherbadges mit dem Logo des Gewinners. 7K+ Besucher werden dieses Badge tragen. 
* Eine 30-minütige Präsentation während der EBE 2020 die in die Agenda aufgenommen und promotet wird. 
* Euer Firmenlogo auf unserer offiziellen Homepage, welches die nächsten 11 Monate sichtbar sein wird. 


Der Wert der Preise beträgt 25 000 EUR.
*WICHTIG: Jeder Preis ist mit bestimmten Kriterien verbunden: Eine bestimmte Anzahl an Punkten (durch das Klicken des personalierten Links) und die Position im Ranking. 
Ihr könnt den Stand in Echtzeit kontrollieren - somit könnt ihr auf das Ergebnis selbst Einfluss nehmen, falls nötig!* 

# Wie kann ich am Wettbewerb teilnehmen? 
Einige einfache Schritte werden benötigt: 

# SOCIAL MEDIA GUIDE
Du kannst selber den Link benutzen oder an Euer PR-Team weiterleiten. Unten wirst du ein paar personalisierte Links finden, die in den sozialen Medien gepostet werden können. 

> Klick hier, um den Post auf Facebook zu teilen
> Klick hier, um den Post auf LinkedIn zu teilen
> Klick hier, um den Post in deinem TT Account zu teilen

Wir haben auch zusätzliche Promomaterialien für (nazwa brandu) vorbereitet. Du kannst diese runterladen, mit einem E-Mail-Newsletter-template, hier (link to zip).

# EXTRA GUIDE
Um den maximalen Erfolg zu gewähren, damit es beim Gewinn eines Preises um bspw. eine Präsentation geht oder andere hochwertige Preise kann es sein, dass ihr eure eigenen Promomaterialien benutzen wollt. Selbstverständlich könnt ihr das machen, nur vergisst dabei nicht, euren personalisierten Link zu benutzen: (link) 

In deinem Ausstellerprofil findest du 4 wichtige Sektionen in Bezug auf den Wettbewerb. 

@component(‘mail::button’, [‘url’ => $accountUrl])
Sign In
@endcomponent

Nur Klicks über den personalisierten Link finden Beachtung im Ranking. 

# Braucht ihr Hilfe? 
Vereinbart mit uns einen Call über diesen Link <link> oder antwortet einfach auf die E-Mail und wir werden euch so gut wie möglich helfen, damit der Wettbewerb für euch ein Erfolg wird. 

Du bist nur einen Klick entfernt von einer Präsentation bei einem der bedeutsamsten Events in der Branche - nutze die Gelegenheit! 

@component(‘mail::panel’)
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Mit besten Grüßen, 

{{$footer}}

@endcomponent

