

@component('mail::message')

# cześć,

## {{$p->translate("[[fname]] [[lname]] z firmy [[cname2]]") }} zakceptował(a) Twoje zaproszenie do spotkania

Oto dane kontaktowe osoby - umów się na spotkanie bezpośrednio

* Imię i nazwisko: {{$p->translate("[[fname]] [[lname]]") }}
* Nazwa firmy: {{$p->translate("[[cname2]]") }}
* Job position: {{$p->translate("[[position]]") }}
* Phone {{$p->translate("[[phone]]") }}
* E-mail {{$p->translate("[[email]]") }}


Dziękujemy, Targi eHandlu

(wysłane do: {{$recipient}})

@endcomponent



