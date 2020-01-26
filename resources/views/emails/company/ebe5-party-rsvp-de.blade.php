

@component('mail::message')
 
Hallo {{$profile->translate("[[fname]]")}},

Die E-commerce Berlin Expo steht in den Startlöchern.
Wir wollen dich freundlicherweise auf die E-commerce Berlin Expo Networking Party aufmerksam machen. 
Bitte klicke auf den Link und füge zwei Vertreter hinzu, die der Party beiwohnen werden. 


@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent


Dein Ausstellerpaket beinhaltet zwei garantierte Tickets für die E-commerce Germany Awards und Networking Party. 
Falls ihr vorhabt mit mehreren Leuten dabei zu sein, dann müssen Extratickets exakt zu der Anzahl der kommenden Leute erworben werden.
Jedes weitere Ticket zu den zwei garantierten muss erworben und bestätigt werden.

Jedes Extraticket wird 49€ kosten. 


* **Informationen: 
Datum: 12.02.2020
Einlass: ab 19 Uhr 
Awards Zeremonie: 20-21 Uhr 
Networking, Drinks und Buffet: 21-23 Uhr 
Ort: Spindler & Klatt, Köpenicker Str. 16-17, 10997 Berlin




Gerne können Sie uns aber auch auf diese E-Mail antworten.
 

Beste Grüße, 

{{$footer}}

@endcomponent



