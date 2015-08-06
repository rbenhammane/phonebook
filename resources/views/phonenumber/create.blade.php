@extends('layouts.master')

@section('title', 'Login Page')

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-4 col-md-offset-4">
    <form method="POST" action="{{ isset($phonenumber) ? '/phonenumber/edit/' . $phonenumber->id : '/phonenumber/create' }}">
        {!! csrf_field() !!}

        @if (isset($phonenumber))
        <input type="hidden" id="id" name="id" value="{{ $phonenumber->id }}">
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ isset($phonenumber) ? $phonenumber->name : old('name') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="tel" id="phone_number" name="phone_number" value="{{ isset($phonenumber) ? $phonenumber->phone_number : old('phone_number') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="notes">Additional Notes</label>
            <textarea id="notes" name="notes" rows="10" class="form-control">{{ isset($phonenumber) ? $phonenumber->notes : old('notes') }}</textarea>
        </div>

        <div class="pull-right">
            <a href="/phonenumber" class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ isset($phonenumber) ? 'Apply' : 'Add' }}</button>
        </div>
    </form>
</div>
@endsection