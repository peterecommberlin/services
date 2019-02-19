

@component('mail::message')

# Hi {{$p->translate("[[fname]]") }} 

You have recently registered for E-commerce Berlin Expo 2019!

We hope to see you TOMORROW (Wednesday; 20th of February) at STATION Berlin.

Have you downloaded your ticket?

Use the button below to download. 

@component('mail::button', ['url' => $url])
Download ticket
@endcomponent

If you cannot print it - don't worry! We will print tickets at the reception desk.

This time we will occupy to **two expo halls** to bring unprecedented quality of listening to the **36 presentations** and learning an offer of **almost 150 exhibitors.**

# More then **6000 participants** from 8 countries have already registered to attend.

Thanks,

E-commerce Berlin Expo Team

@endcomponent
