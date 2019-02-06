

@component('mail::message')
 

# Hi {{$profile->translate("[[fname]]")}}, 

# you have now the opportunity to check who actually signed for the E-commerce Berlin Expo and you’re now able to invite them to your stand. 


@component('mail::button', ['url' => $accountUrl])
Access to dashboard
@endcomponent				


<a href="{{$accountUrl}}"><img src="https://res.cloudinary.com/eventjuicer/image/upload/v1549450516/meetups.png" alt="" style="margin-top: 30px; margin-bottom: 30px;"></a>


# How does it work? 

At the beginning, you have **15 invitations.** If you participate in the contest, which is integrated in the dashboard and you achieve at least 20 points, you get a ** mega package of invitations** (50 additional invitations). This means, you will have 65 invitations for sure. 

For every 5 more points in the contest you will get one more invitation. 
A company with 50 points should have 75 invitations in total. 

# How does it work from the visitors scope? 

The invitations from all exhibitors will be sent bundled once a day. The visitor will have the chance to accept or to refuse your invitation. 

Once the visitor accepted your invitation, you’ll receive the full data of them. 

@component('mail::button', ['url' => $accountUrl])
Access to dashboard
@endcomponent	

regards,

Aleksandra Miedzynska

Jan Sobczak

E-commerce Berlin Team

@endcomponent

