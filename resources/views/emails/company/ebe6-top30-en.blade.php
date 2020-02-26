

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}}!

Congratulations on winning one of top30 spots in the E-commerce Berlin Expo 2020 - promo contest for Exhibitor's!

What does it give you?

* closed sales (no competitors who can reserve your favourite spot before you do)
* lower prices
* all the attractive locations available

On the next Tuesday, **3rd of March** at **10:00 am**, the Early Bird sale for E-commerce Berlin Expo 2021 starts for your company.

The following link will show you the stands and pricing.

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe6top30presales"])
Check the map here
@endcomponent

**Important**: Reservations in this sales round can be made **only on Tuesday (March 3rd by EOD)**
Reservations through the home page won’t be possible.

Best regards,

Lucas Zarna

@endcomponent



