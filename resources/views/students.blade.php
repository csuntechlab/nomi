@extends('master')

@section('content')
<roster-container studentsjson="{{json_encode($students)}}"></roster-container>
@stop
