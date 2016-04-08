@extends('layouts.preauth')

@section('content')
<div>
    <div>
        <h1 class="logo-name">ESH</h1>
    </div>
    <h3>Register to ESPORTS HERO</h3>
    <p>Create account to see it in action.</p>
    <form class="m-t" role="form" action="/users" method='POST'>
        {!! csrf_field() !!}
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" required="">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email" required="">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required="">
        </div>
        <div class="form-group">
            <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

        <p class="text-muted text-center"><small>Already have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="/login">Login</a>
    </form>
</div>
@stop