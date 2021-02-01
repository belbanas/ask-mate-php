@extends('layout')

@section('title', 'Question')

@section('content')

    @component('navbar')

    @endcomponent

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

            @foreach ($tags as $tag )
                <tr>
                    <td>{{$tag['name']}}</td>
                    <form action='/removeTag' method='POST' id='removeTag-{{$tag['name']}}'>
                        <td>
                            <input type='hidden' name='t_id' value='{{$tag['id']}}'/>
                            <a href=""
                               onclick="document.getElementById('removeTag-{{$tag['name']}}').submit(); return false;">
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