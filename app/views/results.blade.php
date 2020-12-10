@extends('layout')

@section('title', 'Question')

@section('content')

    @component('navbar')

    @endcomponent

        <div class="container mt-5">
    @foreach ($questions as $question)
        {{$question->getTitle()}}
    @endforeach
        </div>


@endsection