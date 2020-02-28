

@component('mail::message')
 
# Hello {{ array_get($profile, "fname") }},

The E-commerce Berlin Expo 2020 is past but the preparations for the Expo 2021 (18.02.2021 @ STATION Berlin) have already started. 

# We would like to inform you that on next Thursday, the **5th of March 2020, from 12:00 pm**, the Early Bird sales starts.

What are the benefits of it? 

* get access to the top locations on a lower price 
* secure a premium spot 
* be faster than your competitors 

The fees will start from 2500€ for 9m2 up to 5200€ for 18m2. 

The following link will show you the stands and pricing.

@component('mail::button', [‘url’ => "https://ecommerceberlin.com/exhibit"])
Check the map here
@endcomponent

**ATTENTION!** Please be aware that the Early Bird sales pool will be active until the 31st of March. Afterwards, the fees will increase and you won’t be able to book a spot on the above mentioned prices.

Best regards,

Lucas Zarna

@endcomponent



