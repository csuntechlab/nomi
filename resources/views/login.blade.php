@extends('master')
@section('content')
    <div class="container">
        {{ Form::open(['url' => route('post.login'), 'method' => 'post']) }}
        <h1>Faculty Log In</h1>
        Username
        {{ Form::text('username') }}
        <br>
        Password
        {{ Form::password('password') }}
        <br>
        <loading-button></loading-button>
        {{ Form::close() }}
    </div>
@stop

@section('scripts')
<script>
    localStorage.removeItem('nameface');
</script>
@stop
