

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

# We kindly remind that there is an option (in your Exhibitor account) to browse visitors and send meetup requests...

If the invited person accepts the invitation you will get full contact details and can schedule the meeting with your own tools (email, phone)...

@component('mail::button', ['url' => $accountUrl])
Sign In
@endcomponent

# How does it work...

You have 5 test invites for the start

If you got more than 20 points in the Ranking (Challenge for Exhibitors) you will get extra 50 invites (55 total)


Regards, 

Marta Zaczyk
Jakub Przybylski
Jan Selga
Adam Zygadlewicz

@endcomponent

