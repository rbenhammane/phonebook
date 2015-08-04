
@extends('layouts.master')

@section('title', 'Login Page')

@section('content')
<div id="register_form" class="col-md-4 col-md-offset-4">
    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-default">Register</button>
        </div>
    </form>
</div>
@endsection