

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}}!

## Wir haben uns dein Onlineprofil angeschaut auf der Website der E-commerce Berlin Expo und wollen dich aufmerksam machen, dass dieses noch nicht vollständig ausgefüllt ist. 

@foreach ($errors as $f => $p)
	
**{{$f}}** {{$p}}

@endforeach

Ich möchte Zugriff auf das Profil haben und dieses bearbeiten

@component('mail::button', ['url' => $accountUrl])
Bearbeiten des Ausstellerprofils  
@endcomponent

Der Link zu deinem Onlineprofil   [link]({{$profileUrl}})

@component('mail::panel')

Es ist sehr wichtig, dass das Profil aktualisiert ist. Es ist Voraussetzung um euch ein noch besseren Outcome zu ermöglichen. 

@endcomponent

**Um solche Nachrichten nicht mehr zu bekommen würden wir dich bitten, dass Profil auszufüllen. **

Lieben Gruß,

E-commerce Berlin Expo Team

@endcomponent



