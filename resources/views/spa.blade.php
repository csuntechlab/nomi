@extends('master')
@section('content')
    <error-bar></error-bar>
    <router-view></router-view>
    <div id="menu-bar-padding" style="height:60px"></div>
    <menu-bar></menu-bar>
@stop
