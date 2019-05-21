@component('mail::message')

# Hi {{$profile->translate("[[fname]]")}},

The Early Bird pool sale will start **TODAY (May 21st) at 12:00 PM CET**. It will be available ONLY for exhibitors, that participated in 16th Ecommerce Cracow Expo. 

@component('mail::button', ['url' => "https://admin.targiehandlu.pl/earybirdtop30s4s3s?lang=en"])
BOOK HERE
@endcomponent

The Early Bird Pool will be **limited to about 20 exhibition spaces** However, regular (open for all interested parties) sale will be open 1 PM (also today.)

Regards,

Karolina Michalak, Jakub Przybylski

@endcomponent