

@component('mail::message')
 
# Hello {{$profile->translate("[[fname]]")}},

The Early Bird sale for Exhibitors of the previous edition of the Fair starts **tomorrow at 12:00**.

You can make reservations for the Early Bird price only until the end of the month or until the stands in this pool last. **The number of stands at the lower price is strictly limited.**

The following link will show you the map stands.

@component('mail::button', ['url' => "https://res.cloudinary.com/ecommerceberlin/image/upload/v1551874462/ebe5_floorplan.png"])
Check the map here
@endcomponent

**You will receive valid booking link tomorrow at 11:30 am**

Best regards,

Lucas Zarna

@endcomponent



