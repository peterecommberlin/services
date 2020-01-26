

@component('mail::message')

# Hello {{$profile->translate("[[fname]]")}},

The E-commerce Berlin Expo 2020 is just around the corner.
We’d like to kindly remind you about the E-commerce Berlin Expo 2020 Networking Party.

Please use the link button below and add up to TWO company representatives who will attend the party:

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent


ATTENTION!
Your exhibitor package includes two guaranteed tickets for the E-commerce Germany Awards and Networking Party. 
If you are planning to bring more than two people you need to purchase additional tickets in the amount coresponding to the number of participants. 
Every ticket on top of the guaranteed two needs to be purchased and confirmed.

Please be aware that any additional tickets must be purchased for 49€ each. 


* **Agenda:
Date: 12th February 2020
Entrance: 7 pm
Awards ceremony: 8 pm - 9 pm
Networking, drinks and flying buffet: 9 pm - 11 pm
Location: Spindler & Klatt, Köpenicker Str. 16-17, 10997 Berlin


If you have any questions feel free to contact your Account Manager.


Best Regards,

{{$footer}}

@endcomponent



