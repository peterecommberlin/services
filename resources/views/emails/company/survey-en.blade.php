

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

**We have prepared a questionnaire**, thanks to which we hope to smooth out any sharp organizational edges in the nearest future :)

Please find a few minutes and fill in.

@component('mail::button', ['url' => "https://goo.gl/forms/R6OrYXvhPTGv4uUm1"])
Complete the Survey
@endcomponent

We have published selected photos from the event [on our Facebook fanpage](https://www.facebook.com/pg/targiehandlu/photos/?tab=album&album_id=2631296346880355) 

**We encourage you to find and tag yourself and your friends.**

**All photos in HI-RES quality** will be sent out as soon as we collect a satisfactory number of responses to the survey:)** 
Hopefully it will happen today!

Regards, Adam Zygadlewicz

@endcomponent



