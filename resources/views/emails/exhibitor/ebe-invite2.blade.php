

@component('mail::message')



<div style="text-align: center;">
	<a href="{{$promolink}}" target="_blank"><img src="{{$imageEnc}}" alt="" style="margin-top: 10px; margin-bottom: 30px; max-height: 250px;"></a>
</div>


# Hi,

## We would like to let you know that {{  array_get($companydata, "name") }} is exhibiting at the E-Commerce Berlin Expo 2019 on **20th February 2019** at STATION Berlin, Luckenwalder Str. 4-6.

We’re excited for a day fully dedicated to e-commerce best practices &amp; trends. 
Come have a chat with us at our stand.

@component('mail::button', ['url' => $promolink])
	Register for a free ticket here
@endcomponent

There will be **4 stages** full of speakers and more than **150 other service providers** at their booths. The event is a must-attend!

Looking forward to meet you! 

Kind Regards,


@endcomponent



