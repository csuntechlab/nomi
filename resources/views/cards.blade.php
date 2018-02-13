@extends('welcome')

@section('content')
    <toggle-view-button></toggle-view-button>
    <card-images students="{{json_encode($students)}}"></card-images>
    <grid-view></grid-view>
@stop
