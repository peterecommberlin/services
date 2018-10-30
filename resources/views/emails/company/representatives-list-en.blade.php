

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}},

**You can now add/edit/delete exhibitor's representatives (company staff that will be present at the booth) in your exhibitor's account**

@component('mail::button', ['url' => $accountUrl])
Sign Into My Account
@endcomponent

Please be reminded that in the standard offering you will get 4 catering vouchers and 1 parking card. 

**If you add more that 4 representatives we will contact you whether you would like to purchase additional catering vouchers (10 EUR net / person)** 

(You can of course reply to this email and proactively let us know :-)

Pozdrawiam, Adam Zygadlewicz

@endcomponent



