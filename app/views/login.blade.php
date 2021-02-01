@extends('layout')

@section('title', 'Login')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <h1 class="text-center">Login</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <form action="/login" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                    <p></p>
                    <div class="form-text">If you are not registered click <a href="/registration">here</a>.</div>
                </form>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>


@endsection
