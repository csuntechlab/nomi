@extends('master')
@section('content')
    <div class="loginContainer">
        {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
        <h3 class="loginTitle">LOGIN</h3>
        {{ Form::text('username', null, ['class' => 'loginForm', 'placeholder' => 'Username']) }}
        {{ Form::password('password', ['class' => 'loginForm', 'placeholder' => 'Password']) }}
        <loading-button></loading-button>
        {{ Form::close() }}
    </div>
@stop

@section('scripts')
<script>
    localStorage.removeItem('nameface');
</script>
@stop
