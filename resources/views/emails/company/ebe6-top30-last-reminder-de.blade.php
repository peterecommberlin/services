

@component('mail::message')

# Hello {{ array_get($profile, "fname") }} ,

Die Reservierung der Standflächen **beginnt heute - um 10 Uhr** und wird **bis zum Ende des Tages des 04.03.2020 möglich sein. **

Dieser Link führt euch zur Bookingseite wo ihr alle Standflächen sehen werdet. 

** Wenn du vor 10 Uhr auf die Seite gegangen bist, dann aktualisiere diese, um den aktuellen Stand zu sehen.**

@component('mail::button', ['url' => "https://ecommerceberlin.com/top30earlybird_9f8s83jd"])
Booking map, preise, buche hier
@endcomponent

**WICHTIG!** Buchungen über die Homepage werden nicht möglich sein. 

Der Salesstart für alle anderen beginnt am 05.03.2020.

Mit freundlichen Grüßen,

Lucas Zarna 

@endcomponent