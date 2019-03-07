

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}},

Limited Early Bird sales for Exhibitors of the previous edition of our Expo  starts **today at 12:00**.

You can make reservations for the Early Bird price only until the end of the month or until the stands in this pool last. **The number of stands at the lower price is strictly limited.**

The following link will show you the map stands and make booking possible (at 12:00 :-)

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe5earlybird1200"])
Map, prices, booking here
@endcomponent

Best regards,

E-commerce Berlin Expo Team

@endcomponent



