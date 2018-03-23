@extends('master')
@section('content')
    <list-grid-tabs></list-grid-tabs>
    <router-view></router-view>
    <div class="menu__compensation">
    <menu-bar></menu-bar>
@stop
