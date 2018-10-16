@extends('master') @section('content')

<div id="login" class="login">
    @if ( $errors->count() > 0 )
        <div id="error_bar" class="alert alert--warning login--error" >
            <strong>Oops!</strong> Login Failed
        </div>
    @endif

    <div class="login-container row">
        <div class="login-container__right col-xs-0 col-lg-10">
            <div class="login__branding">
                <img class="login__csun-logo" src="{{ asset('/images/csunlogo-horizontal.svg') }}" alt="CSUN Logo; California State University of Northridge">
            </div>
        </div>

        <div class="login-container__left row col-xs-12 col-lg-6 col-xl-5">
            <div class="login__filter col-xs-0 col-md-12"></div>
            <div class="login__content row col-xs-12 col-lg-8">
                <div class="login__nav-bar"></div>
                <div class="login__wrapper">
                    <img class="login__logo" src="{{ asset('/images/nomi-logo-horizontal.svg') }}" alt="NOMI Logo; Names of Matador Individuals">

                    <div class="login__container">
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
                        
                        <div class="login-loader">
                            <div id="login__loader" class="login-loader__loader">
                                <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
                            </div>
                        </div>
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
        document.getElementById("login__loader").className += " login-loader__loader--active";
        document.getElementById("login__container").className += " login__container--hide";
    }
</script> @stop