

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

**We have enabled a challenge / competition in your exhibitor's account**

What's the idea behind it?

@component('mail::panel')

Some of our premium services are available only for Exhibitors that are promoting their participation in the Expo. 

We believe that a successful event is not only getting to know new customers, but also strengthening relationships with existing clients.

The market value of the services we put to the challenge is higher that 15 000 EUR.

@endcomponent

The Challenge consists in using special link which give you points.

Below please find your special link to your company profile on expo website. Use it when creating newsletters, email footers, advertisement (fb ads, adwords) or directly when informing / promoting on social websites. 

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent


**IMPORTANT: The most precious rewards - 2 presentation slots - will be assigned on Wednesday - 31 OCT at 12:00 CET. The rest of the competition will be enabled till 6 NOV 12:00 CET**

# In your Exhibitor's account you will find 4 important sections related to the Challenge.

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# RANKING

The ranking is created on the basis of data from google analytics with a **24-hour delay.**
When you check the results, you actually see the results from the previous day.

## REWARDS

Each of the prizes requires fulfillment of the conditions for its granting.

* minimal number of points (= pageviews of your public exhibitor's profile)
* position in the ranking

Looking at every listed prize you can see whether your company meets the conditions or not. Please remember that everything may change till the end of the Challenge so it is recommended not to open the champagne until the end of the competition.

## EMAIL TEMPLATES

2 ready-to-send newsletters (polish and english), which are designed to inform your clients and partners about your participation in the event. You can copy HTML or download a zip file that can be easily imported by GetResponse / Mailchimp-like software.

## PROMOTIONAL MATERIALS

3 separate links, which you can share on social websites will render different image

* your logotype on our background with polish invitation
* as above but with english
* custom design (you will need to give full URL to your design in Company Data)

Every link can be copied to clipboard, sent via messenger / @ or used in your designed-from-scratch newsletters.

@component('mail::button', ['url' => $accountUrl])
Sign In  
@endcomponent

# Some of the PRIZES

## Presentation slot on one of the 2 main stages

15-minute presentation slot during upcoming expo. Your presentation will be added to the official agenda and promoted. (That is the reason that this prize will be assigned 31 OCT)

## VIDEO interview

Your company will be video-interviewed at your booth during Expo! You will own the resulting material and also can expect we will promote it after the event. 

## Access to the Early Bird Sales 

Next edition of E-commerce Poland Expo will be held in Cracow in April 2019. Only 30 most ranked companies will benefit from lowest prices and best locations.

## Promotion of the company logo on our website

Your logotype will be promoted during next 5 months - till the next event.

## Mobile app to scan visitors' badges

All your representatives can install iOS / Android apps allowing them to scan visitors' badges (tickets) and collect their contact details. You will be able to download XLS file directly from Exhibitor's account with all scanned visitors from all your connected devices.

## Roll-up in catering zone

Bring your roll-up and place it among visitors in their catering zone. Have some additional traffic at your booth.

## Want to use your own promo materials? Great. Always use the provided link!

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Regards, 

Adam Zygadlewicz

@endcomponent

