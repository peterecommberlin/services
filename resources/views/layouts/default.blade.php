<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>teh</title>

   
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">



<link rel="stylesheet" href="{{ mix('/css/app.css') }}" />




  </head>

  <body>


<script>
window.fbAsyncInit = function() {
FB.init({
appId            : '{{config("promo.fb_app_id", "")}}',
autoLogAppEvents : true,
xfbml            : true,
version          : 'v2.10'
});
FB.AppEvents.logPageView();
};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>



    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        

        <a class="navbar-brand" href="#">{{config("promo.site_name")}}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          

          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">{{$participantName}} <span class="sr-only">(current)</span></a>
            </li>
           

          </ul>
          

        </div>
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">

        @if(config("promo.show_menu"))

        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">

            @include('shared.promomenu')


        </nav>

        @endif

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">

           
          <h1>@yield('title')</h1>


        @include('shared.errors')


          <section class="pb-5 mb-5">

             @yield('content')
            
          </section>

         
          
        </main>
      </div>
    </div>




   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>



    <script src="{{ mix('/js/app.js') }}"></script>


 @stack('scripts')
 

  </body>
</html>












             

            


