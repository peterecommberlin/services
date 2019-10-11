

@component('mail::message')
 
# Hi {{$profile->translate("[[fname]]")}},

**In your exhibitor account you can now add "exhibitor representatives". Only defined representatives will have their badges printed .**

We deeply ask you to submit representatives possibly today or on Monday max. On Tuesday we are starting to print our stuff.

# The list of already defined representatives is as follows:

@forelse($representatives as $rep)

	{{$rep->translate("[[fname]] [[lname]] [[position]]")}}

@empty

**Not yet defined!**

@endforelse


@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

Please remember that in our standard offering you get max 4 catering vouchers (number of representatives = number of vouchers but no more than 4 unless separately ordered via Exhbitor Account Panel).

Regards, Pozdrawiam! 

Karolina Michalak

@endcomponent



