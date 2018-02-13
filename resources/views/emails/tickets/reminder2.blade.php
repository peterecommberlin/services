

@component('mail::message')

# Hi, {{$p->translate("[[fname]]") }} 

We hope to see you 15th of February @ Station Berlin!

@component('mail::button', ['url' => $url])
Download ticket
@endcomponent

## E-commerce Berlin Expo #3 will be HUGE!

@component('mail::panel')
- Over 110 Exhibitors!
- Over 40 Speakers: e-commerce leaders providing you with new insights and new solutions to your daily challenges
- Meet the leading german estores: hear from **L´Oréal, Zalando, Mister Spex, DeinDesign, notesbookbilliger, Scout24, Moebel24** and many more
- Global giants: meet with some of the biggest players from across the globe including **eBay, Google, Facebook, Hewlett Packard** and many more
- Data based overview of the German e-commerce market: in partnership with idealo, listen to Erik Meierhoff will dive into this data pool to showcase the **current status of the German e-commerce market** and sketch opportunities for merchants
- Big ideas keynote: hear from the world biggest marketplace on the start rethinking e-commerce,  **Rob Cassedy - General Manager at eBay Kleinanzeigen**
- Spotlight on the latest trends in retail: evaluate the latest developments in big data, machine learning, bots, payments, logistics and analytics

**[Check the full agenda and speakers here](https://ecommerceberlin.com/#schedule)**

@endcomponent

Your ticket for E-commerce Berlin Expo #3 is ready.
Use the button below to download. Then print. You will access the expo hall and presentations QUICKER.

@component('mail::button', ['url' => $url])
Download ticket
@endcomponent


Thanks,
E-commerce Berlin Expo Team


@endcomponent



