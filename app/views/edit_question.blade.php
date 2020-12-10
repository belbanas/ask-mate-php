@extends('layout')

@section('title', 'Questions')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">

        @if (isset($_SESSION['email']))

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Message</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <form action='/edit_question_handler' method='POST'>
                    <input type='hidden' name='id' value='{{$question->getId()}}'/>
                    <th scope="row">{{ $question->getId() }}</th>
                    <td>
                        <label for="title"></label>
                        <input type="text" value="{{ $question->getTitle() }}" name="title" id="title" required>
                    </td>
                    <td>
                        <label for="message"></label>
                        <input type="text" value="{{ $question->getMessage() }}" name="message" id="message" required>
                    </td>
                    <td><input type="submit" value="Send Request"></td>
                </form>
            </tr>

            </tbody>
        </table>

        @else

            @component('alert')

                <p>You must log in first</p>

            @endcomponent

        @endif

    </div>

@endsection