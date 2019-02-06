
@component('mail::message')
 

# Hallo {{$profile->translate("[[fname]]")}},

** Bitte beachten Sie, dass Sie in Ihrem Aussteller Konto Aussteller Vertreter hinzufügen / ändern / löschen können. Nur definierte Vertreter haben gedruckte Ausweise.**

# DEADLINE ist am Freitag 12:00 pm**

# Die Liste der bereits definierten Vertreter ist wie folgt:

@forelse($representatives as $rep)

	{{$rep->translate("[[fname]] [[lname]] [[position]]")}}

@empty

**Noch nicht definiert!**

@endforelse


@component('mail::button', ['url' => $accountUrl])
Zugang zum Aussteller Konto
@endcomponent

Gerne möchten wir dich daran erinnern, dass ihr im Willkommenspaket:

* 4 Catering Voucher (Startup, Standard, Hot&SuperHot Fläche)
* 6 Catering Vouchers (Grand Fläche) erhaltet.

Wenn **mehr als 4 Vertreter** (Startup, Standard, Hot&SuperHot Fläche) oder mehr als **6 Vertreter** (Grand Fläche) anwesend sind, werden wir euch kontaktieren, falls ihr weitere Catering Voucher (20€/Pers.) hinzufügen möchtet.

Gerne können Sie uns aber auch auf diese E-Mail antworten.

Mit freundlichen Grüßen,
E-commerce Berlin Team

@endcomponent





