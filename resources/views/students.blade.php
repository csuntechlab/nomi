@extends('master')

@section('content')
<big-container studentsjson="{{json_encode($students)}}"></big-container>
@stop
