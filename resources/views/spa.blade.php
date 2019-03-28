@extends('master')
@section('content')
    <error-bar></error-bar>
    <permission-modal></permission-modal>
    <router-view profile="{{ session()->pull('profile') }}" terms="{{ session()->pull('terms') }}"></router-view>
    <side-menu></side-menu>
    <menu-bar></menu-bar>
@stop