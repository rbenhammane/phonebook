@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
@if ($perPage <= $total)
<div class="pull-right">
    <a href="{{ $page > 1 ? '/phonenumber/1' . (isset($search) ? '?search=' . $search : ' ') : 'javascript:void(0)' }}" class="btn btn-default btn-xs"><<</a>
    <a href="{{ $page > 1 ? '/phonenumber/' . ($page - 1) . (isset($search) ? '?search=' . $search : ' ') : 'javascript:void(0)' }}" class="btn btn-default btn-xs"><</a>

    @for ($i = 1; $i <= ceil($total / $perPage); $i++)
        <a href="/phonenumber/{{ $i . (isset($search) ? '?search=' . $search : ' ') }}" class="btn {{ $page == $i ? 'btn-primary' : 'btn-default' }} btn-xs">{{ $i }}</a>
    @endfor

    <a href="{{ $page < ceil($total / $perPage) ? '/phonenumber/' . ($page + 1) . (isset($search) ? '?search=' . $search : ' ') : 'javascript:void(0)' }}" class="btn btn-default btn-xs">></a>
    <a href="{{ $page < ceil($total / $perPage) ? '/phonenumber/' . ceil($total / $perPage) . (isset($search) ? '?search=' . $search : ' ') : 'javascript:void(0)' }}" class="btn btn-default btn-xs">>></a>
</div>
@endif

<form method="GET" action="/phonenumber/{{ $page }}">
    <div class="col-md-4">
        <input type="text" id="search" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control input-sm">
    </div>
    <div class="col-md-offset-4">
        <button type="submit" class="btn btn-primary btn-sm">Search</button>
    </div>
</form>

<form method="POST" action="/phonenumber/delete">
    {!! csrf_field() !!}

    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Phone number</th>
                    <th>Date of adding</th>
                    <th>Additional Notes</th>
                </tr>
            </thead>
            <tbody>
            @if ($phoneNumbers->isEmpty())
                <tr><td colspan="5">No records available.</td></tr>
            @else
                @foreach ($phoneNumbers as $phoneNumber)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $phoneNumber->id }}"></td>
                        <td>{{ $phoneNumber->name }}</td>
                        <td><a href="/phonenumber/edit/{{ $phoneNumber->id }}">{{ $phoneNumber->phone_number }}</a></td>
                        <td>{{ $phoneNumber->created_at->format('m/d/Y') }}</td>
                        <td>{{ $phoneNumber->notes }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <div class="form-group pull-right">
        <button type="submit" class="btn btn-warning">Remove Selected</button>
        <a href="/phonenumber/create" class="btn btn-primary">Add Phone Number</a>
    </div>
</form>
@endsection