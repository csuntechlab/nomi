@extends('welcome')

@section('content')
    <card-images students="{{json_encode($students)}}"></card-images>
@stop
