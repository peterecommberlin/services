

@component('mail::message')
 

# Cześć {{$p->translate("[[fname]]")}},

## Networking czyli bezpośrednie spotkania twarzą w twarz to integralna część każdego dobrego wydarzenia biznesowego. Targi eHandlu nie są wyjątkiem. 

Jak to działa?

@component('mail::panel')
Wystawcy mają dostęp do listy wszystkich zarejestrowanych Zwiedzających **bez dostępu do danych kontaktowych** i mogą wybrać kilka osób, z którymi bardzo chcieliby się spotkać podczas Targów. 
Ta wiadomość to potwierdzenie, że co najmniej 1 WYSTAWCA bardzo chciałby się z Tobą spotkać.
@endcomponent

@component('mail::button', ['url' => $url])
Zobacz listę i zdecyduj czy chcesz się spotkać
@endcomponent

Jeśli nie chcesz się spotkać z konkretnym Wystawcą - nie dostaniesz więcej przypomnień.

Do zobaczenia!

Katarzyna Wicher, Targi eHandlu

@endcomponent



