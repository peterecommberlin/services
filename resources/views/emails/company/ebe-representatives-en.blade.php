

@component('mail::message')


# Hello {{$profile->translate("[[fname]]")}},

You can now add/edit/delete exhibitor's representatives (company staff that will be present at the booth) in your exhibitor's account.

Please be reminded that your **welcome package will include**:

* 4 catering vouchers for Startup, Standard, Hot&SuperHot stands or
* 6 catering vouchers for Grand stand

If you have more than 4 representative (Startup, Standard, Hot&SuperHot stand) or 6 representatives (Grand stand), we will contact you in case you would like to purchase additional catering vouchers (20 EUR net/person)

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

You can of course reply to this email and proactively let us know :)

Regards,
Ecommerce Berlin Expo Team

@endcomponent



