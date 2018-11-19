

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

** We kindly remind that we have prepared a questionnaire**, thanks to which we hope to smooth out any sharp organizational edges in the nearest future :)

If you haven't yet filled in, please...

@component('mail::button', ['url' => "https://goo.gl/forms/R6OrYXvhPTGv4uUm1"])
Complete the Survey
@endcomponent

As soon as at least 50% of the Exhibitors responds we will send an access to HiRes gallery of photos.

Regards, Adam Zygadlewicz

@endcomponent



