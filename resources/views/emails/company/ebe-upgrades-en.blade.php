

@component('mail::message')


# Hello {{$profile->translate("[[fname]]")}},

**In your exhibitor's account admin panel you can now order additional services.**

List of available options is as follows:

* 50 inch LED display (HDMI + USB)
* Permission to distribute leaflets outside booth (think hostess is welcoming visitors near the entrance)
* Exclusive sponsoring of visitor eco bags
* Visitor Badge Sponsoring
* 20x deck chair in the coffee zone's with your logo

and booth arrangement related services: 

* Complete booth arrangement with full-size fullcolor print, counter, leaflet holder
* same as above but with OSB back wall and logotype
* Carpet equipment
* Foldable brochure rack display

We need to emphasize that **some services are limited by quantity and order date**. For instance the booth arrangement options must be ordered till upcoming Friday.

Check out prices, images, specs by clicking the button below. 

@component('mail::button', ['url' => $accountUrl])
Sign Into My Account
@endcomponent

Regards, 
Aleksandra Miedzynska - Key Account Manager
E-commerce Berlin Expo

@endcomponent



