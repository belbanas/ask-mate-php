@extends('layout')

@section('title', 'Ask a Question')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">

        @if (isset($_SESSION['email']))

            <div class="row">
                <div class="col-sm">
                    <h1 class="text-center">Add Answer</h1>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <h3>{{ $question->getTitle() }}</h3>
                    <p>{{ $question->getMessage() }}</p>
                    <form action="/add-answer" method="post">
                        <input type="hidden" name="question_id" value="{{ $question->getId() }}">
                        <label for="message" class="form-label">Answer</label>
                        <div class="input-group mb-3">
                            <textarea id="message" class="form-control" aria-label="With textarea" name="message"
                                      placeholder="Enter your answer" rows="6"></textarea>
                        </div>
                        <button name="answer" type="submit" class="btn btn-primary">Add Answer</button>
                    </form>
                </div>
                <div class="col-sm">
                </div>
            </div>

        @else

            @component('alert')
                <p>You must log in first!</p>
            @endcomponent

        @endif

    </div>

@endsection