@extends('welcome')

@section('content')
    <shuffle-button></shuffle-button>
    <card-images students="{{json_encode($students)}}"></card-images>
<<<<<<< HEAD
    <br>
    <br>
    <ul>
        <li><a href='{!! url('/courses/2173'); !!}'>Course List</a></li>
        <li><a href='{!! url('/students/2173/0') !!}'>Student List</a></li>
        <li><a href='{!! url('students/shuffle/2173/0') !!}'>Shuffled Students</a></li>
        <li><a href='{!! url('logout') !!}'>Logout</a></li>
    </ul>   
=======
>>>>>>> 30fbb6dc6a3992e63fcf4a5f1f2bb30a7c5f1b60
@stop
