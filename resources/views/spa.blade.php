@extends('master')
@section('content')
    <error-bar></error-bar>
    <permission-modal></permission-modal>
    <router-view></router-view>
    <side-menu></side-menu>
    <div id="menu-bar-padding" style="height:60px"></div>
    <menu-bar></menu-bar>
@stop