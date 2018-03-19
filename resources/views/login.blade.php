@extends('master')
@section('content')
<div class="container">
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
</div>
@stop
