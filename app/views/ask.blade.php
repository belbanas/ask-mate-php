@extends('layout')

@section('title', 'Ask a Question')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">

        @if (isset($_SESSION['email']))

            <div class="row">
                <div class="col-sm">
                    <h1 class="text-center">Ask Question</h1>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <form action="/ask" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="title"
                                   placeholder="Enter a question title"
                                   required>
                        </div>
                        <label for="question" class="form-label">Question</label>
                        <div class="input-group mb-3">
                            <textarea id="message" class="form-control" aria-label="With textarea" name="message"
                                      placeholder="Enter your question" rows="6"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload image (optional)</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <button name="ask" type="submit" class="btn btn-primary">Send Question</button>
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