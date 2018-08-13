<!DOCTYPE html>
<html class="theme-login" id="mainBody" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/metaphor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{asset('images/logo.jpg')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="apple-touch-icon" href={{asset('images/apple-touch-icon.png')}}>
        <meta name="apple-mobile-web-app-title" content="NOMI">
    </head>

    <body>
        <div id='app'>
            <nav-bar></nav-bar>
            @if ( $errors->count() > 0 )
                <div id="error_bar" class="alert alert--warning" >
                    <strong>Oops!</strong> Login Failed
                </div>
            @endif
            @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/metaphor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @if(env("PROD"))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src=“https://www.googletagmanager.com/gtag/js?id=UA-123500967-1“></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag(‘js’, new Date());

        gtag(‘config’, ‘UA-123500967-1’);
    </script>
    @endif
    @yield('scripts')
</html>
