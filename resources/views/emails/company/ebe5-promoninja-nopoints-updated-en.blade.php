

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

We noticed that you haven’t taken part in our Exhibitor Contest yet.

#WHAT IS THE CONTEST ABOUT?

**Each of our exhibitors was given a special dedicated link that they can share across social media to generate traffic to the EBE website.** 
Each click coming from your link grants you a point, and extra visibility - since traffic goes directly to your company public profile. 
Only UNIQUE CLICKS through your customized link count towards the ranking (created according to data fetched from Google Analytics). 


Registration on the event website is not required to get a point.

@component(‘mail::button’, [‘url’ => $accountUrl])
Sign In
@endcomponent

*The competition is open until the 4th of February 2020, 11:59 PM CET.*

#Why should you join the contest (free of charge)? 
Long story short: for increasing brand visibility and winning incredible prizes. 


*Speaking of prizes:*

* exclusive branded visitor badges with the winner’s logo handed out to 7K+ visitors during EBE2020. 
* a special 30-minute presentation slot during EBE2020 added and promoted through the official agenda. 
* video interview with your brand, to be promoted after the event
* your company’s logo on our official website, displayed for the next 11 months

The value of the prizes is 25 000  EUR.
*Important: each of the prizes requires meeting several criteria: a minimum number of points (unique page views via a customized link) and position in the ranking. 
You can track your position in real-time, so it is good to keep an eye on it and make extra efforts if needed.*

#HOW TO JOIN THE CONTEST?
There are a few simple ways of doing so. 

#SOCIAL MEDIA GUIDE
You can apply it right now or forward it directly to your PR team. Below, you’ll find a few customized links for you that you can use to share info on your social media profiles:

> click here to share info on your Facebook account 
> click here to share info on your LinkedIn account
> click here to share info on your TT account

We’ve also prepared a special batch of promotional materials for <nazwa brandu>. You can download them, along with an e-mail newsletter template, here <link to zip> 

#EXTRA GUIDE
To maximize your chances of winning the presentation slot or other prizes, you may wish to use some of your own promotional materials. Of course, you can do so - just remember about using your customized link: <link>

*In your Exhibitor’s account, you will find 4 important sections related to the contest.*

@component(‘mail::button’, [‘url’ => $accountUrl])
Sign In
@endcomponent

Only clicks through that link count towards your ranking.

#DO YOU NEED HELP?
Our team is more than happy to assist. Schedule a quick call using the link <link> or simply hit “reply” to this e-mail and we’ll help you get through promotional materials and the rules.

You are just a click away from your presentation slot on one of the biggest e-commerce fairs in the world - why wouldn’t you take your chance now?

@component(‘mail::panel’)
[{{ $trackingLink }}]({{ $trackingLink }}) 
@endcomponent

Best regards, 

{{$footer}}

@endcomponent


