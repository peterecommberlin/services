

@component('mail::message')

# Hi, {{$p->translate("[[fname]]") }} 

Your ticket for E-commerce Berlin Expo #3 is ready. 
Use the button below to download. Then print.

@component('mail::button', ['url' => $url])
Download ticket
@endcomponent


We hope to see you 15th of February @ Station Berlin!


Thanks,
E-commerce Berlin Expo Team


@endcomponent



