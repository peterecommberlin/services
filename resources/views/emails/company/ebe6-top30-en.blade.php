

@component('mail::message')
 
# Hi {{ array_get($profile, "fname") }}!

Congratulations on winning one of top30 spots in the E-commerce Berlin Expo 2020 - promo contest for Exhibitor's!

What does it give you?

* closed -exclusive- sales for upcoming E-commerce Berlin Expo 2021 (18.02.2021 @ STATION Berlin)
* lower prices
* all the attractive locations available

# On the next Wednesday, **4th of March** at **10:00 am**, the TOP30 Super Early Bird **one day sale** for E-commerce Berlin Expo 2021 starts for your company.

The following link will show you the stands and pricing.

@component('mail::button', ['url' => "https://ecommerceberlin.com/top30earlybird_9f8s83jd"])
Check the map here
@endcomponent

Reservations through other pages than linked above will not be possible.

**Important**: Please be reminded, that reservations in this sales round can be made **only on Wednesday (March, 4th by EOD)**

Best regards,

Lucas Zarna

@endcomponent



