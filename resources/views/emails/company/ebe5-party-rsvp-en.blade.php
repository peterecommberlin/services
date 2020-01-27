

@component('mail::message')

# Hello {{$profile->translate("[[fname]]")}},

The E-commerce Berlin Expo 2020 is just around the corner.

We’d like to kindly remind you about the E-commerce Berlin Expo 2020 Networking Party.

Please use the link button below and add your company representatives **who will attend the party**:

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

## ATTENTION!

If you plan to take **more than 2 people** to the party, please add them to the guest list and we will get in touch with you in relation to issue the invoice for any additional guest (above 2). 

** Each additional ticket (above 2 participants) is 49€ worth.**

@component('mail::panel')

## Agenda

Date: **12th February 2020**

**Entrance**: 7pm

**Awards ceremony:** 8pm - 9pm

**Networking, drinks and flying buffet:** 9pm - 11pm

Location: **Spindler & Klatt, Köpenicker Str. 16-17, 10997 Berlin**

@endcomponent

If you have any questions feel free to contact me - your Account Manager.

Best Regards,

{{$footer}}

@endcomponent
