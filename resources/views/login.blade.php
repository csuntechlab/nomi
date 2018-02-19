@extends('master')

@section('content')
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
@stop
