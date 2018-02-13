@extends('welcome')

@section('content')
    <card-images students="{{json_encode($students)}}"></card-images>
    <br>
    <br>
    <ul>
        <ul><a href='{!! url('/courses/2173'); !!}'>Course List</a></ul>
        <ul><a href='{!! url('/students/2173/0') !!}'>Student List</a></ul>
        <ul><a href='{!! url('students/shuffle/2173/0') !!}'>Shuffled Students</a></ul>
        <ul><a href='{!! url('logout') !!}'>Logout</a></ul>
    </ul>
    <br>
    <br>
    <br>
    <br>
    <menu-bar></menu-bar>
@stop
