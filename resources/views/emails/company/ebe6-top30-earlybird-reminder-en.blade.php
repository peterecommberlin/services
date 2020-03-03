

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}},

We would like to kindly remind you about the start of the exclusive sales round for TOP30 companies in the recent Exhibitors' Contest by tomorrow, **4th March 2020 from 10:00 AM**. 

The reservation of exhibition spaces will be available till the 4th March 2020 EOD! 

The sales round for the other exhibitors (from 2020 edition) will be relesed on the 5th of March 2020.

The link below will redirect you to the booking map where you will see all the exhibition spaces available. 

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/top30earlybird"])
Map, prices, booking here
@endcomponent

**IMPORTANT**
Reservations through other pages than linked above will not be possible.

Best regards,

Lucas Zarna 

@endcomponent