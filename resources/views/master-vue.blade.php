<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=no">
        <link rel="stylesheet" href="{{ asset('css/metaphor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        @if ( $errors->count() > 0 )
            ...An error occured...
            @foreach( $errors->all() as $message )
                ...{{ $message }}...
            @endforeach
        @endif

        <script>
            // window.myApp = window.myApp || {};
            var something = {!! json_encode($json) !!}
            console.log(something);
            // something = JSON.stringify(something);
            // something = JSON.parse(something);
            // localStorage.setItem('json', JSON.stringify(something));
            // console.log(sessionStorage.getItem('json'));
        </script>

        <div id='app'></div>
        <script src="{{ asset('js/metaphor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
