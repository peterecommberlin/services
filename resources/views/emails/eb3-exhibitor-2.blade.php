

@component('mail::message')



<div style="text-align: center;">
	<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-top: 10px; margin-bottom: 30px;"></a>
</div>


# Hallo,

# Wir möchten Ihnen mitteilen, dass {{ array_get($participant, "fields.cname2", "") }} als Aussteller auf der diesjährigen E-Commerce Berlin Expo 2018 **am 15. Februar im STATION, Berlin** sein wird. 

Wir freuen uns auf einen Tag rund um den E-Commerce. Kommen Sie auf ein Gespräch mit uns am Stand {{ array_get($participant, "fields.booth") }} vorbei, es wäre schön Sie kennenzulernen! 

@component('mail::button', ['url' => $promolink])
Sie können sich hier für ein kostenloses Ticket registrieren. 
@endcomponent


Wir freuen uns darauf Sie bald zu treffen!

Mit freundlichen Grüßen,
{{ array_get($participant, "fields.cname2", "") }}


@endcomponent



