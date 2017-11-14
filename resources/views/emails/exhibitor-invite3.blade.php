

@component('mail::message')

<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-bottom: 30px;"></a>

# STIMMEN SIE FÜR UNS AB! 

Wir nehmen am CALL FOR PAPERS - CONTEST der E-Commerce Berlin Expo 2018 teil! Die Gewinner bekommen einen Spot auf der EBE Bühne am 15. Februar, 2018 im Station, Berlin. 

Sie können uns dabei unterstützen ein Teil der Agenda zu werden, indem Sie für {{ array_get($participant, "fields.cname2") }}'s Präsentation stimmen. 


## Title unserer Präsentation, “{{ array_get($participant, "fields.presentation_title") }} ”


@component('mail::button', ['url' => $promolink])
Stimmen Sie für unsere Präsentation
@endcomponent


Wir hoffen auf Ihre Unterstützung! 

Vielen Dank!

{{ array_get($participant, "fields.cname2") }}


@endcomponent



