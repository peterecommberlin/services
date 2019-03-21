

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}},

**In your exhibitor's account admin panel you can now order additional services.**

List of available options is as follows:

* Permission to distribute leaflets outside booth (for instance: a hostess is welcoming visitors near the entrance)
* Additional electricity connection - 3000 Watts (instead 300 W) if you plan something more than laptop on your booth
* Additional catering voucher(s)
* Additional parking card(s)
* 50 inch LED display (HDMI + USB) on the stand

and booth arrangement related services: 

* Complete booth arrangement with fullsize fullcolor print, counter, leaflet holder
* same as above but with OSB back wall and logotype
* counter with branding
* flooring carpet
* additional furniture: additional high chair(s) and additional table(s)

We need to emphasize that **some services are limited by quantity and order date**. For instance the booth arrangement options must be ordered till April 5th.

Check out prices, images, specs by clicking the button below. 

@component('mail::button', ['url' => $accountUrl])
Sign Into My Account
@endcomponent

Pozdrawiam, Jakub Przybylski

@endcomponent



