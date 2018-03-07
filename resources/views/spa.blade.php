@extends('master')

@section('content')
<body class="bg--gray">
    <side-bar></side-bar>
    <router-view json="{{json_encode($json)}}"></router-view>
    <menu-bar></menu-bar>
</body>
@stop
