

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}},

Wir möchten euch daran erinnern, dass Morgen die exklusive Salesrunde für die TOP30-Unternehmen aus dem letzten Ausstellerwettbewerb startet und **zwar ab 10 Uhr!**

Die Reservierung der Standflächen wird bis zum Ende des Tages des 04.03.2020 möglich sein. 
Der Salesstart für alle anderen beginnt am 05.03.2020.

Dieser Link führt euch zur Bookingseite wo ihr alle Standflächen sehen werdet. Die Buchungen können ab 10 Uhr vorgenommen werden.

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/top30earlybird"])
Booking map, preise, buche hier

@endcomponent


**WICHTIG!**
Buchungen über die Homepage werden nicht möglich sein. 


Mit freundlichen Grüßen,

Lucas Zarna 

@endcomponent