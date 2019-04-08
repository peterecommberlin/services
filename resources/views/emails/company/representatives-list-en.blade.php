

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

**Please be reminded that in your exhibitor account one can add/modify/delete exhibitor representatives. Only defined representatives will have printed badges.**

**Deadline is TOMORROW (April 9th) - 5 pm CET**

# The list of already defined representatives is as follows:

@forelse($representatives as $rep)

	{{$rep->translate("[[fname]] [[lname]] [[position]]")}}

@empty

**Not yet defined!**

@endforelse


@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

Please remember that in our standard offering you get 4 catering vouchers unless separately ordered.

Regards, Pozdrawiamy! 

Karolina Michalak
Jakub Przybylski

@endcomponent



