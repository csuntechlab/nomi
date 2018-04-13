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
        <loading-button></loading-button>
        {{Form::close()}}
</div>
@stop
