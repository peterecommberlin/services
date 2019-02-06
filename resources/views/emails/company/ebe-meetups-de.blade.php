

@component('mail::message')


# Hallo {{$profile->translate("[[fname]]")}},

# In deinem Ausstellerprofil hast du nun die Möglichkeit, die Besucher der Expo zu sehen und diese zu Gesprächen an deinen Stand einzuladen 

@component('mail::button', ['url' => $accountUrl])
Zugang zum Profil
@endcomponent


<a href="{{$accountUrl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1549450516/meetups.png" alt="" style="margin-top: 30px; margin-bottom: 30px;"></a>


# Wie funktioniert das? 

Am Anfang hast du **15 Einladungen.** Wenn du im Wettbewerb, welcher innerhalb des Dashboards gerade läuft, mindestens 20 Punkte erreichst, erhältst du das sog. Mega **Paket an Einladungen - 50 Stück.** Somit wärst du bei 65 Einladungen. 

Für jede weitere 5 Punkte bekommst du eine Einladung dazu. 
Erreicht jemand 50 Punkte, dann hat man 75 Einladungen insgesamt

# Wie funktioniert das aus Sicht des Besuchers? 

Die Einladungen werden gebündelt und 1x täglich geschickt. Der Besucher hat die Möglichkeit, die Einladung zu akzeptieren oder abzulehnen. 

**In dem Moment, wo der Besucher die Einladung akzeptiert, bekommst du die gesamten Daten von dem Besucher.**

@component('mail::button', ['url' => $accountUrl])
Zugang zum Profil
@endcomponent

regards,

Aleksandra Miedzynska

Jan Sobczak

E-commerce Berlin Team

@endcomponent