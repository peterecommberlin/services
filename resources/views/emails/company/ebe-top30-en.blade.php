

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}}!

Tomorrow, on **March 7th** at **10:00 am**, the Early Bird sale starts for your company - one of the TOP30 companies from the recent Exhibitors Contest.

Reservations can be made **max till 11:30** (there is another sale that starts at 12:00 for rest of the Exhibitors, i.e. outside TOP30).

The following link will show you the stands and pricing.

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe5top30presales"])
Check the map here
@endcomponent

At 10:00 you must use the page above. Reservations through the home page won’t be possible.

Best regards,

Lucas Zarna

@endcomponent



