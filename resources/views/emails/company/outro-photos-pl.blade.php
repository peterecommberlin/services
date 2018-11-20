

@component('mail::message')
 
# Cześć {{$profile->translate("[[fname]]")}},

** Oto Galeria zdjęć z Targów eHandlu z podziałem na firmy Wystawców** 

@component('mail::button', ['url' => "https://goo.gl/forms/R6OrYXvhPTGv4uUm1"])
Przeglądaj folder
@endcomponent

Proszę Cię o [wypełnienie ankiety satysfakcji](https://files.targiehandlu.pl/teh15/) jeśli jeszcze nie mamy Twoich odpowiedzi na nurtujące nas pytania.

PS. Mamy tylko **49 wypełnionych** ankiet.

Pozdrawiam, Adam Zygadlewicz

@endcomponent



