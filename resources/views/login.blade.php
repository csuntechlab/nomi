@extends('master') @section('content')

<div id="login-mobile" class="login">
    <div id="panel__content">
        <div>
            <div id="loginContainer" class="login__container">
                <img id="loginLogo" src="./../public/images/nomi-logo-horizontal.svg" alt="NOMI Logo; Names of Matador Individuals">
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
        </div>
    </div>
    <div id="loginLoader" class="login__loader">
        <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
    </div>
</div>

<div id="login" class="login">
    <div id="panel">
        <div id="panel__right">
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
                    <div id="loginLoader" class="login__loader">
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
        document.getElementById("loginLoader").className += " login__loader--active";
        document.getElementById("loginContainer").className += " login__container--hide";
    }
</script> @stop