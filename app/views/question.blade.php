@extends('layout')

@section('title', 'Question')

@section('content')

    @component('navbar')

    @endcomponent

    <div class="container mt-5">
        <h2>THE TAG</h2>
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
            <tr>
                <th scope="row">{{ $question->getId() }}</th>
                <td>{{ $question->getTitle() }}</td>
                <td>{{ $question->getMessage() }}</td>
                <td>{{ $question->getIdImage() }}</td>
                <td>
                    <form action='/increase-question' method='POST' id='increase-{{$question->getId()}}'>
                        <input type='hidden' name='action' value='increase'/>
                        <input type='hidden' name='id' value='{{$question->getId()}}'/>
                        <input type='hidden' name='q_id' value='{{$question->getId()}}'/>
                        <a href=""
                           onclick="document.getElementById('increase-{{$question->getId()}}').submit(); return false;">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-up-fill"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                            </svg>
                        </a>
                    </form>
                    {{ $question->getVoteNumber() }}
                    <form action='/decrease-question' method='POST' id='decrease-{{$question->getId()}}'>
                        <input type='hidden' name='action' value='decrease'/>
                        <input type='hidden' name='id' value='{{$question->getId()}}'/>
                        <input type='hidden' name='q_id' value='{{$question->getId()}}'/>
                        <a href=""
                           onclick="document.getElementById('decrease-{{$question->getId()}}').submit(); return false;">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </a>
                    </form>
                </td>
                <td>{{ $question->getSubmissionTime() }}</td>
                <td>
                    <form action='/delete' method='POST' id='delete-{{$question->getId()}}'>
                        <input type='hidden' name='action' value='delete'/>
                        <input type='hidden' name='id' value='{{$question->getId()}}'/>
                        <a href=""
                           onclick="document.getElementById('delete-{{$question->getId()}}').submit(); return false;">
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
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h2>ANSWERS</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Message</th>
                <th scope="col">Vote number</th>
                <th scope="col">Submission Time</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($answers as $answer)
                <tr>
                    <td scope="row">{{$answer->getId()}}</td>
                    <td>{{ $answer->getMessage() }}</td>
                    <td>
                        <form action='/increase-answer' method='POST' id='increaseAnswer-{{$answer->getId()}}'>
                            <input type='hidden' name='action' value='increase'/>
                            <input type='hidden' name='id' value='{{$answer->getId()}}'/>
                            <a href=""
                               onclick="document.getElementById('increaseAnswer-{{$answer->getId()}}').submit(); return false;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-up-fill"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg>
                            </a>
                        </form>
                        {{ $answer->getVoteNumber() }}
                        <form action='/decrease-answer' method='POST' id='decreaseAnswer-{{$answer->getId()}}'>
                            <input type='hidden' name='action' value='decrease'/>
                            <input type='hidden' name='id' value='{{$answer->getId()}}'/>
                            <a href=""
                               onclick="document.getElementById('decreaseAnswer-{{$answer->getId()}}').submit(); return false;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </a>
                        </form>
                    </td>
                    <td>{{ $answer->getSubmissionTime() }}</td>
                    <td>
                        <form action='/delete' method='POST' id='delete-{{$answer->getId()}}'>
                            <input type='hidden' name='action' value='delete'/>
                            <input type='hidden' name='id' value='{{$answer->getId()}}'/>
                            <a href=""
                               onclick="document.getElementById('delete-{{$answer->getId()}}').submit(); return false;">
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
        <a href="/add-answer?question_id={{ $question->getId() }}">
            <button type="button" class="btn btn-primary">Add Answer</button>
        </a>
    </div>


    <div class="container mt-5">
        <h2>TAGS</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">!</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <form action='/tagQuestion' method='POST' id='tag-{{$question->getId()}}'>
                    <td>
                        <input type='hidden' name='action' value='tag'/>
                        <input type='hidden' name='q_id' value='{{$question->getId()}}'/>
                        <input type="text" id="tagName" name="tagName">
                    </td>
                    <td>
                        <a href=""
                           onclick="document.getElementById('tag-{{$question->getId()}}').submit(); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                        </a>
                    </td>
                </form>
            </tr>
            @foreach ($question->getTags() as $tag )
                <tr>
                    <form action='/deTag' method='POST' id='deTag-{{$tag['name']}}'>
                        <td>
                            {{$tag['name']}}
                            <input type='hidden' name='action' value='deTag'/>
                            <input type='hidden' name='q_id' value='{{$question->getId()}}'/>
                            <input type='hidden' name='t_id' value='{{$tag['id']}}'/>
                        </td>
                        <td>
                            <a href=""
                               onclick="document.getElementById('deTag-{{$tag['name']}}').submit(); return false;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                     fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                </svg>
                            </a>
                        </td>
                    </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <a href="/">
            <button type="button" class="btn btn-primary">Back</button>
        </a>
    </div>


@endsection