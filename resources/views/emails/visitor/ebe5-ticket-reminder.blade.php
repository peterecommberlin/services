

@component('mail::message')

Hi {{ $p->translate(“[[fname]]“) }},

(unten auf deutsch)

You haven’t downloaded your ticket yet.

# Are you planning to visit E-commerce Berlin Expo this Thursday and check **50 presentations** & over **180 exhibitors**?

# YES!

Please [go to]({{$url}}) and **click on the GREEN button** ( a PDF ticket will be downloaded which we advise you to print if you want to enter the expo faster)

# NO!

Please [go to]({{$url}}) and **click on the RED button** - we will stop sending you reminders! :)


Hallo  {{ $p->translate(“[[fname]]“) }} ,

Du hast bis jetzt Dein Ticket nicht runtergeladen. 

# Planst du bei der E-commerce Berlin Expo am Donnerstag dabei zu sein und dir mehr als 50 Speaker und 180 Aussteller anzusehen?

# Ja

Dann klicke bitte [auf diesen Link]({{$url}}) und **drücke den grünen Button**. (Damit lädst du das Ticket herunter und kannst somit schneller der Expo beiwohnen)

# Nein

Dann klicke bitte [auf diesen Link]({{$url}}) und **drück den roten Button**. Damit hören wir auf dich darauf anzusprechen.

Danke,

Das E-commerce Berlin Expo Team


@endcomponent



