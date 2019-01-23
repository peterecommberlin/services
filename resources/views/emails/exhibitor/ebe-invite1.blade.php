

@component('mail::message')



<div style="text-align: center;">
	<a href="{{$promolink}}" target="_blank"><img src="{{$imageEnc}}" alt="" style="margin-top: 10px; margin-bottom: 30px; max-height: 250px;"></a>
</div>


# Hallo,

## Gerne möchten wir Ihnen mitteilen, dass {{  array_get($companydata, "name") }} als Aussteller auf der E-commerce Berlin Expo 2019 am 20. February dabei sein wird.

Wir freuen uns auf einen Tag rund um den E-commerce und die neuesten Trends der Industrie. Treffen Sie uns an unserem Stand!

Des Weiteren werden Speaker auf 4 verschiedenen Bühnen auftreten und mehr als 150 Dienstleister ausstellen. Wir freuen uns Sie auf der Veranstaltung persönlich zu treffen!

@component('mail::button', ['url' => $promolink])
	Register for a free ticket here
@endcomponent

Mit freundlichen Grüßen,


@endcomponent



