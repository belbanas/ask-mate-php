@extends('layout')

@section('navbar')
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ask Mate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="#">Questions</a>
                    <a class="nav-link" href="#">Ask question</a>
                    <a class="nav-link" href="#">Search</a>
                    <a class="nav-link" href="#">List users</a>
                </div>
            </div>
        </div>
    </nav>
    </div>
@endsection