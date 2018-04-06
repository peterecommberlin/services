

@component('mail::message')
 

# Hi, {{$p->translate("[[fname]]")}},

## Successful networking is crucial part of every business event. We have developed a tool to have that networking boosted. 

@component('mail::panel')
Selected exhibitors have an exclusive and limited access to the list of names of registered visitors. They are allowed to choose people they would love to meet during an expo. If you receive this message, you were chosen! Now decide if you share that interest...or not :) If you approve the meetup, exhibitor would be able to contact with you directly and schedule the meeting.
@endcomponent

@component('mail::button', ['url' => $url])
Approve or reject meetup requests
@endcomponent

Looking forward to see you! 

Kind Regards, E-commerce Berlin Expo Team.


@endcomponent



