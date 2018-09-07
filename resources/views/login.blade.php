@extends('master') @section('content')

<div id="login-mobile" class="login">
    <div>
            <div id="loginContainer">
            <img id="loginLogo" src="{{ asset('/images/nomi-logo-horizontal.svg') }}" alt="NOMI Logo; Names of Matador Individuals">
                {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
                <h1 id="loginTitle" class="loginTitle">LOGIN</h1>
                <div class="input-container">
                    {{ Form::text('username', null, ['class' => 'login__username', 'placeholder' => 'Username']) }}
                    <label for="username">Username</label>
                </div>
                <div class="input-container">
                    {{ Form::password('password', ['class' => 'login__password', 'placeholder' => 'Password']) }}
                    <label for="password">Password</label>
                </div>
                <button class="loginButton btn btn-primary" type="submit" onclick="loading()">
                    Submit
                </button>
                {{ Form::close() }}
            </div>
    </div>
    <div id="loginLoader" class="login__loader">
        <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
    </div>
</div>

<div id="login" class="login">
    <div class="login-container row">
        <div class="login-container__right col-xs-0 col-lg-10">
            <div class="login__branding">
                <img class="login__csun-logo" src="{{ asset('/images/csunlogo-horizontal.svg') }}" alt="CSUN Logo; California State University of Northridge">
            </div>
        </div>

        <div class="login-container__left row col-xs-12 col-lg-6 col-xl-5">
            <div class="login__filter col-xs-0 col-md-12"></div>
            <div class="login__content row col-xs-12 col-lg-8">
                <div class="login__wrapper">
                    <img class="login__logo" src="{{ asset('/images/nomi-logo-horizontal.svg') }}" alt="NOMI Logo; Names of Matador Individuals">

                    <div id="login__container" class="login__container">
                        {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
                        <h1 class="login__title">LOGIN</h1>
                        <div class="login__input-container">
                            {{ Form::text('username', null, ['class' => 'login__username', 'placeholder' => 'Username']) }}
                            <label for="username">Username</label>
                        </div>
                        <div class="login__input-container">
                            {{ Form::password('password', ['class'=> 'login__password', 'placeholder' => 'Password']) }}
                            <label for="password">Password</label>
                        </div>
                        <button class="login__button btn btn-primary" type="submit" onclick="loading()">
                            Submit
                        </button>
                        {{ Form::close() }}
                    </div>

                    <div id="login__loader" class="login__loader">
                        <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
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
<<<<<<< HEAD
        document.getElementById("login__loader").className += " login__loader--active";
        document.getElementById("login__container").className += " login__container--hide";
=======
        document.getElementById("loginContainer").className += " login__container--hide";
>>>>>>> 4e831eeca376fc84254fea29e249c7c1960b7d63
    }
</script> @stop