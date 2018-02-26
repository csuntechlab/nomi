@extends('master')

@section('content')
<roster-container roster="{{json_encode($students)}}"></roster-container>
@stop
