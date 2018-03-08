@extends('master')

@section('content')
<body class="bg--gray">
<div class="container">
    <router-view json="{{json_encode($json)}}"></router-view>
    <side-bar></side-bar>
    <menu-bar></menu-bar>
</div>
</body>
@stop
