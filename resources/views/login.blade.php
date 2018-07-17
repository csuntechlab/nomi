@extends('master') @section('content')
<div id="loginInput" class="loginContainer">
    {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
    <h3 id="loginTitle" class="loginTitle">LOGIN</h3>
    {{ Form::text('username', null, ['class' => 'loginForm', 'placeholder' => 'Username']) }} {{ Form::password('password', ['class'=>
    'loginForm', 'placeholder' => 'Password']) }}
    <button class="loginButton btn btn-primary" type="submit" onclick="loading()">
        Submit
    </button>
    {{ Form::close() }}
</div>
<div id="loginLoader" class="login_load">
    <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
</div>

@stop @section('scripts')
<script>
    localStorage.removeItem('nameface');

    function loading() {
        console.log("success!");
        document.getElementById("loginLoader").className += " login_load_active";
        document.getElementById("loginInput").className += " loginContainer_hide";
    }
</script> @stop