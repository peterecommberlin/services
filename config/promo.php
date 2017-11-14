<?php



return str_contains(request()->getHttpHost(), "ecommerceberlin") ? 

array(

"site_name" => "E-commerce Berlin #3",
    
"fb_app_id" => "",

"show_menu" => 0,

"twitter_site" => "@ecommerceberlin",

"link" =>  "https://ecommerceberlin.com/presentations/%d?utm_source=partner_%d&utm_medium=%s&utm_campaign=cfpvoting&utm_content=%s",

"email_subject" => "E-commerce Berlin #3",

"og_title" => "",

"og_description" => ""

) : 

array(

"site_name" => "Targi eHandlu",
    
"fb_app_id" => "171440222951000",

"show_menu" => 0,

"twitter_site" => "@targiehandlu",

"link" =>  "https://targiehandlu.pl/?utm_source=partner_%d&utm_medium=%s&utm_campaign=promoninja_exhibitors&utm_content=%s",

"email_subject" => "Spotkajmy się 8 listopada w Warszawie!",

"og_title" => "8 listopada będziemy na stoisku %s",

"og_description" => "Wstęp FREE. %s zaprasza na XIII Targi eHandlu na EXPO XXI w Warszawie. Blisko 140 Wystawców, 22 prezentacje Ekspertów."

) 


;
