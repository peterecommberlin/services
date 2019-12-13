

@component('mail::message')
 

Hallo {{$profile->translate("[[fname]]")}},

 
Sie können nun Firmenvertreter in Ihrem Ausstellerprofil hinzufügen/aktualisieren/löschen (Mitarbeiter, welche Ihre Firma am Stand  repräsentieren werden).
 
Gerne möchten wir dich daran erinnern, dass ihr im Willkommenspaket:

* **4 Catering Vouchers** (Startup, Standard, Hot&SuperHot Fläche) or
* **6 Catering Vouchers** (Grand Fläche) erhaltet.

Wenn mehr als 4 Vertreter (Startup, Standard, Hot&SuperHot Fläche) // 6 Vertreter (Grand Fläche) anwesend sind, werden wir euch kontaktieren, falls ihr weitere Catering Voucher (20€/Pers.) hinzufügen möchtet.

@component('mail::button', ['url' => $accountUrl])
Sing In to add or edit
@endcomponent

Gerne können Sie uns aber auch auf diese E-Mail antworten.
 
Mit freundlichen Grüßen,

Jan Sobczak - Account Manager 

E-commerce Berlin Expo

Sie können nun Firmenvertreter in Ihrem Ausstellerprofil hinzufügen/aktualisieren/löschen (Mitarbeiter, welche Ihre Firma am Stand  repräsentieren werden).

Gerne möchten wir dich daran erinnern, dass ihr im Willkommenspaket:

* 4 Catering Voucher (Startup, Standard, Hot&SuperHot Fläche)
* 6 Catering Vouchers (Grand Fläche) erhaltet.

Wenn **mehr als 4 Vertreter** (Startup, Standard, Hot&SuperHot Fläche) oder mehr als **6 Vertreter** (Grand Fläche) anwesend sind, werden wir euch kontaktieren, falls ihr weitere Catering Voucher (20€/Pers.) hinzufügen möchtet.

Gerne können Sie uns aber auch auf diese E-Mail antworten.



Mit freundlichen Grüßen,
E-commerce Berlin Team

@endcomponent



