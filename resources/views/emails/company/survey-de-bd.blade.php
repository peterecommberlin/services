
@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

**Wir haben eine Umfrage erstellt um zu wissen**, was wir in Zukunft verbesseren könnten. 
Die Umfrage nimmt nur ein paar Minuten in Anspruch.

@component('mail::button', ['url' => "https://forms.gle/DgCoXsnGgnv4nieL6"])
Fülle die Umfrage aus
@endcomponent 

Wir haben auf unserer Facebook Fanpage Fotos von der E-commerce Berlin Expo 2020 hochgeladen.(https://www.facebook.com/pg/ecommerceberlin/photos/?tab=album&album_id=3063981610281458) 

**Wir empfehlen dir, dich oder deine Freunde darauf zu markieren.**


Regards,
E-commerce Berlin Expo Team

@endcomponent