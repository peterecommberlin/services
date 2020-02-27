

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}}!

Herzlichen Glückwunsch! Du bist in den TOP-30 im Ausstellerwettbewerb der E-commerce Berlin Expo gelandet.

Welchen Vorteil hat das? 

* exklusiver Sales (keiner von der Konkurrenz kann vor euch eine Topfläche buchen)
* Niedrige Preise 
* Zugang zu allen Topflächen

Nächsten Dienstag, d.h. am **03.03.20 um 10 Uhr** beginnt der Vorverkauf für euer Unternehmen für die E-commerce Berlin Expo 2021. 

Der nachfolgende Link bringt euch zur Bookingseite. Dort werdet ihr die Preise sehen. 

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe6top30presales"])
Check the map here
@endcomponent

**WICHTIG!**: Buchungen in diesem Stadium können nur am 03.03.02 bis Tagesablauf getätigt werden. 
Buchungen über die Homepage werden nicht möglich sein.  

Mit besten Grüßen,

Lucas Zarna

@endcomponent