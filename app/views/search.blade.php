@extends('layout')

@section('title', 'Question')

@section('content')

    @component('navbar')

    @endcomponent

    <form action="/search" method="GET" class="form-inline md-form mr-auto mb-4">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="string">
        <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
    </form>



@endsection