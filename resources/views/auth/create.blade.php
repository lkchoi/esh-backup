@extends('layouts.preauth')

@section('content')
<div>
    <div>
        <h1 class="logo-name">ESH</h1>
    </div>
    <h3>Log in</h3>
    <form class="m-t" role="form" action="/auth" method='POST'>
        {!! csrf_field() !!}
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username or Email" name="username_or_email" required="">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required="">
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

        <a href="#"><small>Forgot password?</small></a>
        <p class="text-muted text-center"><small>Do not have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
    </form>
</div>
@stop