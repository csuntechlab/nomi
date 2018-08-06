@extends('master') @section('content')

<div id="login-mobile" class="login">
    <div id="loginInput" class="loginContainer">
        {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
        <h1 id="loginTitle" class="loginTitle">LOGIN</h1>
        {{ Form::text('username', null, ['class' => 'loginForm', 'placeholder' => 'Username']) }} {{ Form::password('password', ['class'=>
        'loginForm', 'placeholder' => 'Password']) }}
        <button class="loginButton btn btn-primary" type="submit" onclick="loading()">
            Submit
        </button>
        {{ Form::close() }}
    </div>
</div>

<div id="login" class="login">
    <div id="panel">
        <div id="panel__right">
            <div>
                <img id="backgroundImage" src="./../public/images/desktop-background.png" alt="Background Image; Man holding a red book">
            </div>

            <div id="loginBranding">
                <img id="csunLogo" src="./../public/images/csunlogo-horizontal.svg" alt="CSUN Logo; California State University of Northridge">
            </div>
        </div>

        <div id="panel__left">
        <div id="filter"></div>
            <div id="panel__login">
                <div id="panel__content">
                    <img id="loginLogo" src="./../public/images/nomi-logo-horizontal.svg" alt="NOMI Logo; Names of Matador Individuals">

                    <div id="loginInput">
                    {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
                        <h1 id="loginTitle" class="loginTitle">LOGIN</h1>
                        {{ Form::text('username', null, ['class' => 'loginForm', 'placeholder' => 'Username']) }} {{ Form::password('password', ['class'=>
                        'loginForm', 'placeholder' => 'Password']) }}
                        <button class="loginButton btn btn-primary" type="submit" onclick="loading()">
                            Submit
                        </button>
                        {{ Form::close() }}
                    </div>

                    <div id="loginLoader" class="loginLoader">
                        <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>

@stop @section('scripts')
<script>
    localStorage.removeItem('nameface');

    function loading() {
        document.getElementById("loginLoader").className += " loginLoader--active";
        document.getElementById("loginInput").className += " loginContainer--hide";
    }
</script> @stop