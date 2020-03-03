

@component('mail::message')
 
# Hello {{ array_get($profile, "fname") }},

We would like to kindly remind you about the **limited Early Bird sales round for Exhibitors of the previous edition of the E-commerce Berlin Expo by **tomorrow, 5th March 2020 from 12:00 PM**.

# You can make reservations for the Early Bird price only until the end of the month (31.03.20). After this date, the Early Bird offer will expire and the prices for exhibition spaces will increase.

The link below will redirect you to the booking map where you will see all the exhibition spaces available. 

@component('mail::button', ['url' => "https://ecommerceberlin.com/exhibit"])
Check the map here
@endcomponent

**ATTENTION!** 
Please be aware that some of the spots are already booked and marked as "R" for companies from the recent Exhibitors' Contest. These exhibition space won't be available in the sales process. 
The Early Bird sales pool will be active until the 31st of March. Afterwards, the fees will increase and you won't be able to book a spot on the above mentioned prices.

Best regards,

Lucas Zarna

@endcomponent



