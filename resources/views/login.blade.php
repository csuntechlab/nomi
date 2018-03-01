@extends('master')

@section('content')
<div class="container" id='app'>
    {{Form::open()}}
    Login
    <br>
    Username
    {{Form::text('username')}}
    <br>
    Password
    {{Form::password('password')}}
    <br>
    {{Form::submit('Log In')}}
    {{Form::close()}}
</div>
@stop
