

@component('mail::message')

# Hi, {{$p->translate("[[fname]]") }} 

You have registered and hopefully attended previous edition of E-commerce Berlin Expo.
We would like to see you again **on Thursday - 15th of February at STATION Berlin**.

Entrance is FREE! 

## Are your contact details correct?

* Name: {{$p->translate("[[fname]] [[lname]]") }}
* Company name: {{$p->translate("[[cname2]]") }}
* Job position: {{$p->translate("[[position]]") }}
* Phone {{$p->translate("[[phone]]") }}

If yes? You can download your fresh ticket directly:

@component('mail::button', ['url' => $url])
Skip registration - Download ticket
@endcomponent

If your contact details are more valid we advise you to [register here](https://ecommerceberlin.com/preorder?ticket_id=1122) - it takes only approx. 60 seconds!

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

New registration: [Register here](https://ecommerceberlin.com/preorder?ticket_id=1122)

Thanks,
E-commerce Berlin Expo Team


@endcomponent



