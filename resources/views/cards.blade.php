@extends('welcome')

@section('content')
    <toggle-view-button></toggle-view-button>
    <card-images students="{{json_encode($students)}}"></card-images>
    <list-view></list-view>
@stop
