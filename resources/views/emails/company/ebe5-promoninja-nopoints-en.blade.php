

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

We noticed that you haven’t taken part in our Exhibitor Contest.

If you want to win a presentation slot on one of our stages and gain some extra brand visibility (your logotype on official badges, leaflets or video interviews), taking part in the Contest is the easiest way to do so!

For now, the top 3 companies are: xxx (yy point), yyy (zz points), zzz (ooo points).

How can we help you?

1. Do you want to schedule a 10 min chat with us? We can briefly discuss how to use promotional materials. Please use the link below to choose the most suitable time for you: calendly.com/costam....

2. Below, you’ll find a quickstart guide (with your customized links) to check how simple it is to take part in the Contest. Alternatively, you can forward this message to a person responsible for PR in your company. 

Quickstart quide

a) Click here to share info on your Facebook account
b) Click here to share info on your Linkedin account
c) Click here to share info on your Twitter account
d) Download a ready-to-send .zip package with an e-mail newsletter

Each click coming from your link grants you a point, and extra visibility - since traffic goes directly to your company public profile. 

If you would like to earn points using your own promo materials, you can do it with your customized link (plase find it below). 
Use it when creating newsletters, e-mail footers, advertisement (FB ads, adwords, social media) or when directly informing your clients.


@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent


**  IMPORTANT: the competition is open until the 4th of February 2020, 11:59 PM CET.**

#  In your Exhibitor’s account, you will find 4 important sections related to the Contest.

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# RANKING

The ranking is created according to data fetched from Google Analytics.


## REWARDS

Each of the prizes requires meeting several criteria:

- a minimum number of points (unique page views via a customized link) 
- position in the ranking. 

You can track your position in real-time, so it is good to keep an eye on it and make extra efforts if needed (getting additional points, extra promotion) since your position can be changed anytime. 


# PRIZES

## Exclusive branded visitor badges

Exclusive branded visitor badges with the Winner’s logo. The badges will be handed out to all of the visitors (7000+) during the E-commerce Berlin Expo 2020.

## Presentation slot on one of our stages

30-minute presentation slot during the upcoming Expo. Your presentation will be added and promoted via the official agenda. 

## VIDEO interview

Your company will be video-interviewed at your booth during Expo! You will receive the promotional material, we will promote it after the event as well.

## Promotion of the company logo on our website

Your company’s logo on our official website, displayed for the next 11 months - until the EBE 2021.

## Do you want to create and use your own promo materials in the Contest? That’s great - always use the provided link!

## Each click coming from your link gives you one point. Only UNIQUE CLICKS through your customized link count towards the ranking. 


@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Regards, 

{{$footer}}

@endcomponent

