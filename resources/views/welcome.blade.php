<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//cdn.metalab.csun.edu/metaphor/css/metaphor.css">
        <body>
            {{Form::open()}}
            Login
            <br>
            Username
            {{Form::text('username')}}
            <br>
            Password
            {{Form::password('password')}}
            <br>
            {{Form::submit('submit')}}
            {{Form::close()}}
        </body>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div class="container" id='app'>
            <card-images></card-images>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="//cdn.metalab.csun.edu/metaphor/js/metaphor.js"></script>
    </body>
</html>
