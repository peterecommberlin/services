

@component('mail::message')

# Hello  {{ array_get($profile, "fname") }},

Do you want to scan Guests' tickets visiting your stand during E-commerce Berlin Expo and gather their contact details?

There's An App For That.

Please be informed that **it is offered "as is"** and we are unable to offer any additional assistance and customer support during the setup day and event day.

# Downloading an App.

## Android users

Search for the [E-commerce Berlin Exhibitor in Play store](https://play.google.com/store/apps/details?id=com.eventjuicer.ebe.exhibitors). Skip to **Authentication** info below.

## iOS users

(it is a bit more complicated)

Open an App Store, search for [Expo Client](https://apps.apple.com/us/app/expo-client/id982107779) and install. 

Open browser and go to [https://expo.io/@eventjuicer/ebe-exhibitor](https://expo.io/@eventjuicer/ebe-exhibitor) and scan visible QR code with your mobile camera - inquiry about opening an app (in Expo Client) should follow. You can also use "Request a link via email or text message." if encounter any problems.

# Authentication

Open the app. Click on the "user icon". Search for your company name {{ array_get($company, "name") }} and enter your password shown below:

@component('mail::panel')

**{{ array_get($company, "password") }}**

@endcomponent

# Usage

There are two main screens. Barcode scanner and list of **your scans.** Every couple of minutes we try to sync your list of scans with our serves. The full list of scans (from all your company's representatives) should appear on your exhibitor account under "Scans" page. There is an export to .xlsx.

@component('mail::panel')

Please be informed that the app is offered "as is" and we are unable to offer any additional assistance and customer support during the setup day and event day.

We did our best testing it but this is relatively fresh addon to our toolset for Exhibitors.

@endcomponent

Regards,

{{$footer}}

@endcomponent



