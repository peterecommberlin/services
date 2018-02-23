

@component('mail::message')

# Dear, {{$p->translate("[[fname]]") }} 


## We greatly appreciate your time and interest in our event. We hope that we were able to provide an insightful and memorable event for you. 

To further improve our expo in the future, we kindly ask for your feedback. Please share your experience with us and get access to the photos from the expo in return.

Please, click on the button below to visit your account and complete the short survey.

@component('mail::button', ['url' => $url])
Fill in satisfaction survey
@endcomponent

Thank you once again for taking part in the E-Commerce Berlin Expo 2018 and we’d be really excited to see you again in 2019.


Thank you!    
Expo Team

PS: photos are here http://bit.ly/ecommerceberlin3photos


@endcomponent


