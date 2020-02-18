

@component('mail::message')
 
# Hi {{ array_get($profile, "fname") }},

**We have prepared a questionnaire**, thanks to which we hope to smooth out any sharp organizational edges in the nearest future :)

Please find a few minutes and fill in.

@component('mail::button', ['url' => $pollUrl ])
Complete the Survey
@endcomponent 

We have published selected photos from the event [on our Facebook fanpage](https://www.facebook.com/pg/ecommerceberlin/photos/?tab=album&album_id=3063981610281458) 

**We encourage you to find and tag yourself and your friends.**


Regards,

E-commerce Berlin Expo Team

@endcomponent