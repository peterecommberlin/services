
@component('mail::message')
 

# Hallo {{ array_get($profile, "fname") }},

** Bitte beachten Sie, dass Sie in Ihrem Aussteller Konto Aussteller Vertreter hinzufügen / ändern / löschen können. Nur definierte Vertreter haben gedruckte Ausweise.**

# DEADLINE ist am 15. Januar

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

* **4 Catering Vouchers** (Startup, Standard, Hot&SuperHot Fläche) or
* **6 Catering Vouchers** (Grand Fläche) erhaltet.

Wenn mehr als 4 Vertreter (Startup, Standard, Hot&SuperHot Fläche) // 6 Vertreter (Grand Fläche) anwesend sind, werden wir euch kontaktieren, falls ihr weitere Catering Voucher (20€/Pers.) hinzufügen möchtet.

Gerne können Sie uns aber auch auf diese E-Mail antworten.

Mit freundlichen Grüßen,

{{$footer}}

@endcomponent





