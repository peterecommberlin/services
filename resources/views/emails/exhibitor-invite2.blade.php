

@component('mail::message')



<div style="text-align: center;">
	<a href="{{$promolink}}"><img src="{{$imageEnc}}" alt="" style="margin-top: 10px; margin-bottom: 30px;"></a>
</div>


# VOTE FOR US!

## We are participating in the CALL FOR PAPERS - CONTEST of the **E-Commerce Berlin Expo 2018!** Winners will be granted a spot on the EBE stage on **February 15, 2018** at Station, Berlin! 


You can help us become part of the agenda by voting for our presentation proposal “{{ array_get($participant, "fields.presentation_title") }}” below: 

@component('mail::button', ['url' => $promolink])
Click here to go to the voting page
@endcomponent


We’re looking forward to your support! 

Thank you!
{{ array_get($participant, "fields.cname2") }}


@endcomponent



