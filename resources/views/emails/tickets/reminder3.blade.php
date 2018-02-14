

@component('mail::message')

# Hi, {{$p->translate("[[fname]]") }} 

We hope to see you tomorrow at STATION Berlin!

Some info you might find important:

- We meet at STATION Berlin ( Luckenwalder Str. 4-6 ). Access to the Expo hall will be via intermediate hall on the right
- You cannot park your car here... please use  **"Parkhaus Gleisdreieck"** (10 EUR for the whole day) or use the public transport 
- If you managed to print your ticket, please don't forget it. You should skip the queues 
- If you were not able to print it, don't worry. We will print it for you at the registration desks
- **Exhibition &amp; presentations are FREE**
- Presentations start from **10:15**. We will try to open main entrance before 10:00 to give you a chance to drink a coffee before presentations start
- Catering zone is located in the smaller hall - together with Stage D / Awards Stage
- We are closing at 5 p.m.

# Can't wait to meet you! :)

@component('mail::button', ['url' => $url])
No ticket? Download it now and print :)
@endcomponent


Thanks,
E-commerce Berlin Expo Team


@endcomponent



