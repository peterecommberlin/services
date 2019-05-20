@component('mail::message')

# Hi {{$profile->translate("[[fname]]")}},

The Early Bird pool sale will start on Tuesday **May 21st** at **12:00 PM**. It will be available for all the exhibitors, that participated in 16th Ecommerce Cracow Expo. 

@component('mail::button', ['url' => "https://admin.targiehandlu.pl/earybirdtop30s4s3s?lang=en"])
BOOKING AND HALL 
@endcomponent

The Early Bird Pool will be limited to about 20 booths. However, regular (open) sale will open right after it is exhausted (1 PM same day.)

Regards,

Karolina Michalak, Jakub Przybylski

@endcomponent