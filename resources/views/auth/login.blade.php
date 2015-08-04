@extends('layouts.master')

@section('title', 'Login Page')

@section('content')
<div id="login_form" class="col-md-4 col-md-offset-4">
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" id="password">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-default">Login</button>
        </div>

        <div>
            <span>New user, <a href="/auth/register">register here.</a></span>
        </div>
    </form>
</div>
@endsection