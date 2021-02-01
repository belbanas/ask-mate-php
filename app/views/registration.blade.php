@extends('layout')

@section('title', 'Registration')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <h1 class="text-center">Registration</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <form action="/registration" method="post">
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
                    <button name="register" type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>

@endsection