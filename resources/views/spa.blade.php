@extends('master')

@section('content')
<side-bar></side-bar>
<router-view json="{{json_encode($json)}}"></router-view>
<menu-bar></menu-bar>
@stop
