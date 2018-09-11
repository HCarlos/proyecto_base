<meta charset="utf-8" />

<link href="{{ asset('images/favicon/favicon.png') }}" rel="shortcut icon">
<link href="{{ asset('images/favicon/favicon-72-72.png') }}" rel="shortcut icon" sizes="72x72">
<link href="{{ asset('images/favicon/favicon-114-114.png') }}" rel="apple-touch-icon" sizes="114x114">
<link href="{{ asset('images/favicon/favicon-157-157.png') }}" rel="apple-touch-icon" sizes="157x157">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>
<link href="https://fonts.googleapis.com/css?family=Raleway|PT+Sans+Narrow|Roboto:400,400i,500,500i|Roboto+Mono|Roboto+Condensed|Kaushan+Script&effect=3d-float" rel="stylesheet">
<!-- third party css -->
<link href="{{ asset('css/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
<!-- App css -->
<link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/my_style_sheet.css') }}" rel="stylesheet">

@yield('styles')
