@extends('master')
@section('content')
    <error-bar></error-bar>
    <permission-modal></permission-modal>
    <router-view profile="{{ session()->pull('profile') }}" term="{{ session()->pull('term') }}"></router-view>
    <side-menu></side-menu>
    <div id="menu-bar-padding" style="height:80px"></div>
    <menu-bar></menu-bar>
@stop