@extends('layout')

@section('title', 'Ask a Question')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <h1 class="text-center">Ask Question</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <form action="/ask" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" id="title"
                               placeholder="Enter a question title"
                               required>
                    </div>
                    <label for="question" class="form-label">Question</label>
                    <div class="input-group mb-3">
                        {{--                        <span class="input-group-text">With textarea</span>--}}
                        <textarea id="question" class="form-control" aria-label="With textarea" name="question"
                                  placeholder="Enter your question" rows="6"></textarea>
                    </div>
                    <button name="ask" type="submit" class="btn btn-primary">Send Question</button>
                </form>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>

@endsection