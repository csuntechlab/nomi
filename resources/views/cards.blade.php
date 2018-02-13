@extends('welcome')

@section('content')
    <shuffle-button></shuffle-button>
    <card-images students="{{json_encode($students)}}"></card-images>
@stop
