@extends('master')

@section('content')
<body class="bg--gray">
<div class="container">
    <router-view json="{{json_encode($json)}}"></router-view>
</div>
<side-bar></side-bar>
<menu-bar></menu-bar>
</body>
@stop
