@extends('master')

@section('content')
<courses-container coursesjson="{{json_encode($courses)}}"></courses-container>
@stop
