@extends('layout')

@section('title', 'Question')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">User Id</th>
                <th scope="col">User Email</th>
                <th scope="col">Registration Date</th>
                <th scope="col">Count of asked questions</th>
                <th scope="col">Count of answers</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->getId()}}</td>
                    <td>{{$user->getEmail()}}</td>
                    <td>{{$user->getRegistrationTime()}}</td>
                    <td>{{$user->getNumberOfQuestions()}}</td>
                    <td>{{$user->getNumberOfAnswers()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/"><button type="button" class="btn btn-primary">Back</button></a>
    </div>

@endsection