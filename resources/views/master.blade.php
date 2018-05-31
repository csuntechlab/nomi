<!doctype html>
<html class="theme-OnceAMatadorAlwaysAMatador" id="mainBody" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-url" content="{{ url('/') }}">
        <meta name="current-term" content="{{env('CURRENT_TERM')}}">
        <link rel="stylesheet" href="{{ asset('css/metaphor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{asset('images/logo.jpg')}}">
        <link rel="apple-touch-icon" href="{{asset('images/logo.jpg')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="apple-touch-icon" href={{asset('/images/apple-touch-icon.png')}}>

    </head>

    <body>
        @if ( $errors->count() > 0 )
            ...An error occured...
            @foreach( $errors->all() as $message )
                ...{{ $message }}...
            @endforeach
        @endif

        <div id='app'>
            <nav-bar></nav-bar>
            @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/metaphor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</html>
