

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

** Nadal czekamy na wypełnienie ankiety przez minimum 50% Wystawców by wysłać dostęp do galerii HI-RES z podziałem na firmy.** 

Póki co mamy tylko **30 wypełnionych** ankiet. Szału nie ma :)

Jeśli jeszcze nie mamy Twoich odpowiedzi - prośba o poświęcenie kilku minut i wypełnienie.

@component('mail::button', ['url' => "https://goo.gl/forms/R6OrYXvhPTGv4uUm1"])
Wypełnij ankietę
@endcomponent

Pozdrawiam, Adam Zygadlewicz

@endcomponent



