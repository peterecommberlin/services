

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}}!

TODAY at **10:00 am**, the **Early Bird sale** for E-commerce Berlin Expo 2020 starts for your company - one of the TOP30 companies from the recent expo edition's Exhibitors Contest.

Reservations can be made **max till 11:30** (there is another sale - with higher prices - that starts at 12:00 for rest of the Exhibitors, i.e. outside TOP30).

**At 10:00 you must use the page linked below.**

Reservations through the home page won’t be possible.

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe5top30presales"])
Map, prices, booking here
@endcomponent


Best regards,

E-commerce Berlin Expo Team

@endcomponent



