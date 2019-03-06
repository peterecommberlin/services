

@component('mail::message')
 
# Halo {{$profile->translate("[[fname]]")}}!

Morgen, d.h. Am **07.03.2019 10:00** beginnt die Early-Bird-Verkaufsphase für die TOP 30 aus dem Wettbewerb. Euer Unternehmen befand sich unter den TOP 30. :) 

Die Möglichkeit der Buchung im Early-Bird-Topf ist **bis 11:30** Uhr möglich (um 12 Uhr beginnt der offizielle Verkauf für die Aussteller, die nicht unter den TOP 30 waren.) 

Hier kannst du dich mit dem Flächenplan vertraut machen

@component('mail::button', ['url' => "https://pages.ecommerceberlin.com/ebe5top30presales"])
Flächenplan
@endcomponent

Das Anschauen und reservieren wird nur über den oben genannten Button möglich sein. Der Zugriff über die Homepage ist nicht möglich. 

Lieben Gruß,

Lucas Zarna 


@endcomponent

