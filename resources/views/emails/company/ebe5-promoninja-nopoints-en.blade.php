

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

We have noticed that you haven't taken part in our Exhibitor Contest.

If you want to rule the presentation stage or gain extra brand visibility (logotype on the badges, leaflets, video interviews) that's the easiest and effortless way to achieve that. 

Top 3 companies are: xxx (yy point), yyy (zz points), zzz (ooo points).

How could we help you?

1. Do you want to schedule a 10 min chat with us - we will briefly discuss how to use promotional materials. Please use this link to choose most suitable time for you - calendly.com/costam....

2. Read quickstart quide (with your dedicated links) to check how easy it is to rule the Contest. you can forward this message to person responsible for PR.

Quickstart quide

a) Click here to share information on your facebook account
b) Click here to share information on your linkedin account
c) Click here to share information on your twitter account
d) Download ready to send .zip package with email newsletter

With each click coming from shared info you will gain points - all traffic goes to your company public profile on E-commerce Berlin Expo website so except joining the contest you will maximize your participantion in Expo!

If you would like to gain points using your own promo materials - there is also an easy way to do it.

Please find your customized link below. Use it when creating newsletters, email footers, advertisement (fb ads, adwords, social media) or when directly informing your clients.

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent


**  IMPORTANT: The competition will be enabled till 4th February 11:59 PM CET**

# In your Exhibitor's account you will find 4 important sections related to the Challenge.

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# RANKING

The ranking is created on the basis of data fetched from our google analytics.


## REWARDS

Each of the prizes requires fulfillment of the conditions for its granting.

* minimal number of points (= pageviews of your public exhibitor's profile)
* position in the ranking

Looking at every listed prize you can see whether your company meets the conditions or not. Please remember that everything may change till the end of the Challenge so it is recommended not to open the champagne until the end of the competition.

# Some of the PRIZES

## Exclusive branded visitor badges

Exclusive branded visitor badges with the Winner's logo. The badges will be handed out to all of the visitors (7000+) during the E-commerce Berlin Expo 2020.

## Presentation slot on one of our stages

30-minute presentation slot during upcoming expo. Your presentation will be added to the official agenda and promoted. 

## VIDEO interview

Your company will be video-interviewed at your booth during Expo! You will own the resulting material and also can expect we will promote it after the event. 

## Promotion of the company logo on our website

Your logotype will be promoted during next 11 months - till the next event.

## Want to use your own promo materials? Great. Always use the provided link!

## Every click through your customized link to the E-commerce Berlin Expo website gives you one point. 

We are counting only unique clicks on your customized link. Registration at the event website is NOT required to get a point. 

@component('mail::panel')
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Regards, 

{{$footer}}

@endcomponent

