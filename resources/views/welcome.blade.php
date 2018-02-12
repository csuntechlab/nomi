<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('css/metaphor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="icon" href="{{asset('images/logo.jpg')}}">
        <link rel="apple-touch-icon" href="{{asset('images/logo.jpg')}}">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div class="container" id='app'>
            <nav-bar></nav-bar>
            <side-bar></side-bar>
            @yield('content')
        </div>
            <script src="{{ asset('js/metaphor.js') }}"></script>
            <script src="{{ asset('js/app.js') }}"></script>
    </body>
     
</html>
