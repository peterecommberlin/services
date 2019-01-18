

@component('mail::message')



<div style="text-align: center;">
	<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-top: 10px; margin-bottom: 30px;"></a>
</div>




Hallo,

Gerne möchten wir Ihnen mitteilen, dass {{COMPANY}} als Aussteller auf der E-commerce Berlin Expo 2019 am 20. February dabei sein wird.

Wir freuen uns auf einen Tag rund um den E-commerce und die neuesten Trends der Industrie. Treffen Sie uns an unserem Stand  {{BOOTH}}!

Des Weiteren werden Speaker auf 4 verschiedenen Bühnen auftreten und mehr als 150 Dienstleister ausstellen. Wir freuen uns Sie auf der Veranstaltung persönlich zu treffen!

Mit freundlichen Grüßen,







# Hi,

## We would like to let you know that {{  array_get($companydata, "name") }} is exhibiting at the E-Commerce Warsaw Expo 2018 on **November 7th** at EXPO XXI (Prądzyńskiego str.), Warsaw. 

We’re excited for a day fully dedicated to e-commerce best practices &amp; trends. 
Come have a chat with us at our stand.


@component('mail::button', ['url' => $promolink])
	Register for a free ticket here
@endcomponent

Let us also mention that there will be 3 stages full of speakers and more than 130 other service providers at their booths. The event is a must-attend! 

Looking forward to meet you! 

Kind Regards,


@endcomponent



