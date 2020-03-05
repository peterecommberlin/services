

@component('mail::message')

# Hi {{ array_get($profile, "fname") }},

Wir wollen dich auf den Beginn des exklusiven Early-Bird-Sales' aufmerksam machen, der **nur für die Aussteller der letzten Expo vorgesehen ist.**

# Dieser beginnt heute (5.03.2020), ab 12 Uhr.

Der Link unten wird dich zur Bookingseite weiterleiten wo du alle Standflächen sehen wirst. 

@component('mail::button', ['url' => "https://ecommerceberlin.com/exhibit"])
Hier zur Bookingseite
@endcomponent

**WICHTIG!** Es kann sein, dass einige Flächen mit einem „R“ versehen sind, d.h diese Standfläche ist bereits vergeben, da die TOP30 aus dem Ausstellerwettbewerb diese bereits ergattert haben.


Mit freundlichen Grüßen,

Lucas Zarna 

@endcomponent



