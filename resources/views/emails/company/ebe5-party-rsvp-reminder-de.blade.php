

@component('mail::message')
 
# Hallo {{ array_get($profile, "fname") }},

Die E-commerce Berlin Expo steht in den Startlöchern.

Wir möchten dich darüber informieren, dass die Anmeldefrist für die **E-commerce Berlin Expo Networking Party**:

## Mittwoch, am 5.02.2020 (Tagesende) 

zu Ende geht. Danach wird es nicht mehr möglich sein, Vertreter Eures Unternehmens auf die Gästeliste einzutragen.

@component('mail::panel')

## Informationen: 

Ort: **Spindler & Klatt, Köpenicker Str. 16-17, 10997 Berlin**

Datum: **12.02.2020**

**Einlass:** ab 19 Uhr

**Awards Zeremonie:** 20-21 Uhr

**Networking, Drinks und Buffet:** 21-23 Uhr 

@endcomponent

## Bitte klicke auf den Link und füge die **Firmenvertreter hinzu, die der Party beiwohnen werden.**

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

<img src="https://res.cloudinary.com/eventjuicer/image/upload/v1580134883/ebe_interface_party_de.png" style="margin-top: 10px; margin-bottom: 30px;" />

Falls du planst, **mehr als zwei Gäste auf die Party mitzunehmen**, dann füge diese zur Gästeliste hinzu. Wir werden uns im Anschluss bei dir wegen der Rechnung melden für jedes weitere Ticket zu den bereits zwei vorhandenen. 

**Jedes weitere Ticket kostet 49€.**

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

Gerne können Sie uns aber auch auf diese E-Mail antworten.
 
Beste Grüße, 

{{$footer}}

@endcomponent
