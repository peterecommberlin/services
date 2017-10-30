<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>



	<title>{{ $title }}</title>

	<meta property="og:title" content="{{$title}}"/>
	<meta name="description" content="{{$description}}"/>

	<meta property="og:description" content="{{$description}}" />
	<meta property="og:type" content="website" />

	<meta property="og:image" content="{{$image}}?1" />
	<meta property="og:image:secure_url" content="{{$image}}?1"/>
	
	<meta property="og:url" content=" "/>

	<meta property="fb:app_id" content="{{config("promo.fb_app_id")}}"/>

	<meta name="twitter:title" content="{{$title}}"/>

	
	<meta name="twitter:image" content="{{$image}}?1"/>

	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:description" content="{{$description}}"/>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">
	
	<meta name="description" content="{{$description}}">

</head>

<body>
	@yield('content')
</body>
</html>





























