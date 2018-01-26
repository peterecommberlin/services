

@component('mail::message')



<div style="text-align: center;">
	<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-top: 10px; margin-bottom: 30px;"></a>
</div>


# Hi,

## We would like to let you know that {{ $fields->translate("[[cname2]]") }} is exhibiting at the E-Commerce Berlin Expo 2018 on **February 15th** at STATION, Berlin. 

We’re excited for a day fully dedicated to e-commerce best practices &amp; trends. 
Come have a chat with us at stand {{ $fields->translate("[[booth]]") }}.


@component('mail::button', ['url' => $promolink])
Register for a free ticket here
@endcomponent

Looking forward to meet you! 

Kind Regards,
{{ array_get($participant, "fields.cname2") }}

@endcomponent



