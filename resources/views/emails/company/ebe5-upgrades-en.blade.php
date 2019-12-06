

@component('mail::message')

# Hello {{$profile->translate("[[fname]]")}},

**We'd like to kindly remind you about the deadline for your exhibition space arrangements and the bookings of our additional services.**

You can find all the details regarding our additional services by clicking the button below (then please navigate to the “add services” tab):

@component('mail::button', ['url' => $accountUrl])
Sign Into My Account
@endcomponent

The **offer is valid until the 31st of December 2019**

From the 1st of January 2020, the price will increase, and you will have only two weeks to upgrade your exhibition space

## REMEMBER!

**Your regular exhibition space includes: **

* basic furniture staff
* 500W electricity connection
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



