

@component('mail::message')
 

# Cześć {{$p->translate("[[fname]]")}},

## Networking czyli bezpośrednie spotkania twarzą w twarz to integralna część każdego wydarzenia biznesowego. Targi eHandlu nie są wyjątkiem. Kilka dni temu oddaliśmy Wystawcom narzędzie pozwalające na lepsze poznanie kto może ich potencjalnie odwiedzić na stoisku.

@component('mail::panel')
Wystawcy mają dostęp do listy Zwiedzających **bez dostępu do danych kontaktowych** i mogą wybrać kilka osób, z którymi bardzo chcieliby się spotkać podczas Targów. 
Ta wiadomość to potwierdzenie, że WYSTAWCA bardzo chciałby się z Tobą spotkać.
@endcomponent

@component('mail::button', ['url' => $url])
Zobacz listę i zdecyduj czy chcesz się spotkać
@endcomponent

Do zobaczenia!

Jan Selga, XV Targi eHandlu

@endcomponent



