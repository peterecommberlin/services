

@component('mail::message')
 
# Hello {{ array_get($profile, "fname") }} ,

The exclusive reservation of exhibition spaces will start at 10:00 and will be available **till the end of the day - 4th of March 2020**

The button below will redirect you to the booking map where you will see all the exhibition spaces available. 

@component('mail::button', ['url' => "https://ecommerceberlin.com/top30earlybird_9f8s83jd"])
Map, prices, booking here
@endcomponent

**If you check the website before 10 AM, we ask you to refresh the booking page to see the current status of exhibition spaces(ctrl+r/cmd+r)**

**IMPORTANT** Reservations through other pages than linked above will not be possible.

The sales round for the other exhibitors (from 2020 edition) will be released tomorrow - on the 5th of March 2020.

Best regards,

Lucas Zarna 

@endcomponent