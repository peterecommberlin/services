

@component('mail::message')

# Hello {{$profile->translate("[[fname]]")}},

**We'd like to kindly remind you about the final deadline for your exhibition space arrangements and the bookings of our additional services.**

You can find all the details regarding our additional services by clicking the button below (then please navigate to the “add services” tab):

@component('mail::button', ['url' => $accountUrl])
Sign Into My Account
@endcomponent

The **offer is valid until the 15th of Janumary 2020**
After this date, your order will be not accepted!


## REMEMBER!

**Your regular exhibition space includes: **

* basic furniture staff (1 table, 2 bar stools)
* 500W electricity connection (it's insufficient if you are planning to have additional equipment e.g. coffee machine)
* WiFi connection 

**Your regular exhibition DOES NOT include:**

* the back wall, 
* carpet lay, 
* TV screen,
* and other additional services.

You can use our supplier to cover and provide all those things for you or do it by yourself.

If you have any questions feel free to contact us. 

Best,

Jan Sobczak - Key Account Manager

E-commerce Berlin Expo

+49 30 2555 9875

The E-commerce Berlin Expo Team

@endcomponent



