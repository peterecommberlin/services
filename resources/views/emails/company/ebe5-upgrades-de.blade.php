

@component('mail::message')

# Hallo {{$profile->translate("[[fname]]")}},

**Wir wollen dich daran an die Deadline für die Zusatzleistungen rund um euren Auftritt bei der E-commerce Berlin Expo aufmerksam machen.** 

Du kannst alle Informationen diesbezüglich hier finden:  

@component('mail::button', ['url' => $accountUrl])
Zu meinem Account gelangen
@endcomponent

**Das Angebot gilt bis zum 31.12.19.**

Ab dem 01.01.20 werden die Preise hierfür steigen und das Buchen jener Leistungen wird nur noch 2 Wochen lang möglich sein. 

## BEACHTE! 

**Dein Ausstellungsfläche beinhaltet folgende Leistungen: **

* Grundmobiliar 
* 500W Strom 
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

