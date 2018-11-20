

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

** Below you can find a link to gallery of photos from recent E-commerce Warsaw Expo event.**  Photos have been divided into folders (by exhibitor's brand name) to save your time :)  

@component('mail::button', ['url' => "https://goo.gl/forms/R6OrYXvhPTGv4uUm1"])
Browse photos
@endcomponent

We kindly remind to [fill in satisfaction survey](https://files.targiehandlu.pl/teh15/) if we do not have your answers.

Regards, Adam Zygadlewicz

@endcomponent


