@extends('welcome')

@section('content')
    <card-images :students="{!! json_encode(Session::get('students')) !!}"></card-images>
    <br>
    <br>
    <ul>
        <li><a href='{!! url('/courses/2173'); !!}'>Course List</a></li>
        <li><a href='{!! url('/students/2173/0') !!}'>Student List</a></li>
        <li><a href='{!! url('students/shuffle/2173/0') !!}'>Shuffled Students</a></li>
        <li><a href='{!! url('logout') !!}'>Logout</a></li>
    </ul>
@stop
