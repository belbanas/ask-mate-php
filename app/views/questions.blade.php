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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection