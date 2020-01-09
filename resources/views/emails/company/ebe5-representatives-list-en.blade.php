

@component('mail::message')


# Hello {{$profile->translate("[[fname]]")}},

**Please be reminded that in your exhibitor account one can add/modify/delete exhibitor representatives. Only defined representatives will have printed badges.**

# Deadline is FRIDAY 12:00 pm CET

# The list of already defined representatives is as follows:

@forelse($representatives as $rep)

	{{$rep->translate("[[fname]] [[lname]] [[position]]")}}

@empty

**Not yet defined!**

@endforelse

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent


Please be reminded that your **welcome package will include**:

* 4 catering vouchers for Startup, Standard, Hot&SuperHot stands or
* 6 catering vouchers for Grand stand

If you have more than 4 representative (Startup, Standard, Hot&SuperHot stand) or 6 representatives (Grand stand), we will contact you in case you would like to purchase additional catering vouchers (20 EUR net/person)



You can of course reply to this email and proactively let us know :)

Regards,

{{$footer}}

@endcomponent



