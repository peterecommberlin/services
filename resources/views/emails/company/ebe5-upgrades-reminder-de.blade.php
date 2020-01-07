

@component('mail::message')

# Hallo {{$profile->translate("[[fname]]")}},

**Wir wollen dich letztmals an die Möglichkeit der Bestellung von zusätzlichen Dienstleistungen für die E-Commerce Berlin Expo aufmerksam machen.** 

Du kannst alle Informationen diesbezüglich hier finden:  

@component('mail::button', ['url' => $accountUrl])
Zu meinem Account gelangen
@endcomponent

**Das Angebot gilt bis zum 15.01.2020**
Nach diesem Datum wird Ihre Bestellung nicht mehr angenommen!



## BEACHTE! 

**Dein Ausstellungsfläche beinhaltet folgende Leistungen: **

* Grundmobiliar (2 Hocker und 1 Tische)
* 500W Strom (ist unzureichend für den Anschluss einer Kaffeemaschine beispielsweise)
* WLAN 

**Deine Ausstellungsfläche beinhaltet nicht:**

* Rückwand 
* Teppich 
* TV-Bildschirm 
* und anderes 

Du kannst hierfür unser Angebot annehmen oder selbstständig hierfür zuständig sein. 

Bei Rückfragen stehen wir Dir gerne zur Verfügung. 

Mit freundlichen Grüßen, 

Jan Sobczak - Key Account Manager

E-commerce Berlin Expo

+49 30 2555 9875

Das E-commerce Berlin Expo Team 


@endcomponent

