@extends('navbar')

@section('title', 'Questions')

@section('content')

    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Message</th>
                <th scope="col">Picture</th>
                <th scope="col">Vote number</th>
                <th scope="col">Submission Time</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr>
                    <th scope="row">{{ $question->getId() }}</th>
                    <td>{{ $question->getTitle() }}</td>
                    <td>{{ $question->getMessage() }}</td>
                    <td>{{ $question->getIdImage() }}</td>
                    <td>{{ $question->getVoteNumber() }}</td>
                    <td>{{ $question->getSubmissionTime() }}</td>
                    <td>
                        <form action='/delete' method='POST' id='form'>
                            <input type='hidden' name='action' value='delete'/>
                            <input type='hidden' name='id' value='{{$question->getId()}}'/>
                            <a href="" onclick="document.getElementById('form').submit(); return false;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                     fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                </svg>
                            </a>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection