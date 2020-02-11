<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unsubscribe from E-commerce Berlin Expo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        
                    @else
                       
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    
                     <p>
                       <a href="{{ action('UnsubscribeController@muteEvent', ['hash'=>$hash]) }}">Opt out from <strong>CURRENT (2020) edition</strong> E-commerce Berlin Expo</a>
                    </p>

                <!--     <p>
                        <a href="{{ action('UnsubscribeController@muteLocation', ['hash' => $hash]) }}">Opt out from Berlin <strong>w Warszawie</strong></a>
                    </p>
 -->
                    <p>
                        <a href="{{ action('UnsubscribeController@muteGroup', ['hash'=> $hash]) }}">Opt out from <strong>CURRENT and FUTURE editions</strong> of E-commerce Berlin Expo</a>
                    </p>
                   
                   
                </div>

                <div class="links">
                 
                </div>
            </div>
        </div>
    </body>
</html>
