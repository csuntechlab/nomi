@extends('master')
@section('content')
<div class="container">
    <body class="off-white">
        {{Form::open()}}
        <h1>Log In</h1>
        Username
        {{Form::text('username')}}
        <br>
        Password
        {{Form::password('password')}}
        <br>
        <button type="submit" class="btn btn-default">Log In</button>
        {{Form::close()}}
    </body>
</div>
@stop
