

@component('mail::message')

# Hi {{ array_get($profile, "fname") }},

Wir wollen dich auf den Beginn des exklusiven Early-Bird-Sales' aufmerksam machen, der nur für die Aussteller der letzten Expo vorgesehen ist. Dieser beginnt am Donnerstag, den 05.03.20 ab 12 Uhr.

# Reservierungen in diesem Salespool sind nur bis zum 31.03.20 möglich. Danach gibt es keinen Early-Bird mehr und die Preise werden steigen.


Der Link unten wird dich zur Bookingseite weiterleiten wo du alle Standflächen sehen wirst. 

@component('mail::button', ['url' => "https://ecommerceberlin.com/exhibit"])
hier zur Bookingseite
@endcomponent

**WICHTIG!** 
Es kann sein, dass einige Flächen mit einem „R“ versehen sind, d.h diese Standfläche ist bereits vergeben, da die TOP30 aus dem Ausstellerwettbewerb diese bereits ergattert haben. Diese Flächen werden dann nicht mehr verfügbar sein. 
Der Early-Bird-Verkauf wird bis zum 31.03 gültig sein. Danach wird es nicht mehr möglich sein, die Flächen zu den Preisen zu buchen. 

Mit freundlichen Grüßen,

Lucas Zarna 

@endcomponent



