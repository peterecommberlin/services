

@component('mail::message')
 
# Hallo {{ array_get($profile, "fname") }},

Die E-commerce Berlin Expo steht in den Startlöchern.

Wir wollen dich freundlicherweise auf die **E-commerce Berlin Expo Networking Party** aufmerksam machen. 

Bitte klicke auf den Link und füge die **Firmenvertreter hinzu, die der Party beiwohnen werden.**

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent


Falls du planst, **mehr als zwei Gäste auf die Party mitzunehmen**, dann füge diese zur Gästeliste hinzu. Wir werden uns im Anschluss bei dir wegen der Rechnung melden für jedes weitere Ticket zu den bereits zwei vorhandenen. 

**Jedes weitere Ticket kostet 49€.**

@component('mail::panel')

## Informationen: 

Datum: **12.02.2020**

**Einlass:** ab 19 Uhr

**Awards Zeremonie:** 20-21 Uhr

**Networking, Drinks und Buffet:** 21-23 Uhr 

Ort: **Spindler & Klatt, Köpenicker Str. 16-17, 10997 Berlin**

@endcomponent

Gerne können Sie uns aber auch auf diese E-Mail antworten.
 
Beste Grüße, 

{{$footer}}

@endcomponent
