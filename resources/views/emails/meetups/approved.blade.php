

@component('mail::message')

# Hi,

## {{$p->translate("[[fname]] [[lname]] from [[cname2]]") }} have just accepted your meetup request


Once the request is approved you have an access to contact data. 
Please schedule meeting by replying to this email or calling {{$p->translate("[[fname]]") }} directly.

* Name: {{$p->translate("[[fname]] [[lname]]") }}
* Company name: {{$p->translate("[[cname2]]") }}
* Job position: {{$p->translate("[[position]]") }}
* Phone {{$p->translate("[[phone]]") }}
* E-mail {{$p->translate("[[email]]") }}


Thanks,
E-commerce Berlin Expo Team

(sent to: {{$recipient}})

@endcomponent



