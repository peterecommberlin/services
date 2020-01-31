

@component('mail::message')
 

Hi  {{ array_get($profile, "fname") }}, 

# you have now the opportunity to check who actually signed for the E-commerce Berlin Expo and you’re now able to invite them to your stand. 

@component('mail::button', ['url' => $accountUrl])
Access to dashboard
@endcomponent				

<a href="{{$accountUrl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1549450516/meetups.png" alt="" style="margin-top: 30px; margin-bottom: 30px;"></a>


# How does it work? 

At the beginning, you have **30 invitations.** If you participate in the contest, which is integrated in the dashboard and you achieve at least 50 points, you get a ** mega package of invitations** (50 additional invitations).

For every 50 more points in the contest you will get package of 50 more invitation. 
A company with 200 points should have 200 invitations in total. 

# How does it work from the visitors scope? 

The invitations from all exhibitors will be sent bundled once a day. The visitor will have the chance to accept or to refuse your invitation. 

Once the visitor accepted your invitation, you’ll receive the full data of them. 

@component('mail::button', ['url' => $accountUrl])
Access to dashboard
@endcomponent	

regards,

{{$footer}}

@endcomponent

