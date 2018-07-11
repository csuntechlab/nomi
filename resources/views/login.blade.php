@extends('master')
@section('content')
    <div class="loginContainer">
        {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
        <h2 class="loginTitle">LOGIN</h2>
        Username
        {{ Form::text('username', null, ['class' => 'loginForm']) }}
        Password
        {{ Form::password('password', ['class' => 'loginForm']) }}
        <loading-button></loading-button>
        {{ Form::close() }}
    </div>
@stop

@section('scripts')
<script>
    localStorage.removeItem('nameface');
</script>
@stop
