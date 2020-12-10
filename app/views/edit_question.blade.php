@extends('layout')

@section('title', 'Questions')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">

        @if (isset($_SESSION['email']))

            <div class="row">
                <div class="col-sm">
                    <h1 class="text-center">Edit Question</h1>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <form action="/edit_question_handler" method="post">
                        <input type='hidden' name='id' value='{{$question->getId()}}'/>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="title"
                                   value="{{ $question->getTitle() }}">
                        </div>
                        <label for="question" class="form-label">Question</label>
                        <div class="input-group mb-3">
                            <textarea id="message" class="form-control" aria-label="With textarea" name="message"
                                      rows="6">{{ $question->getMessage() }}</textarea>
                        </div>
                        <button name="edit" type="submit" class="btn btn-primary">Send Question</button>
                    </form>
                </div>
                <div class="col-sm">
                </div>
            </div>

        @else

            @component('alert')

                <p>You must log in first</p>

            @endcomponent

        @endif

    </div>

@endsection