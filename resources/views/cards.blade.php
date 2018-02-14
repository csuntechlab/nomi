@extends('welcome')

@section('content')
    <toggle-view-button></toggle-view-button>
    <grid-view studentsjson="{{json_encode($students)}}"></grid-view>
    <list-view></list-view>
@stop
