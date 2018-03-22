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
        <loading-button></loading-button>
        {{Form::close()}}
    </body>
</div>
@stop
