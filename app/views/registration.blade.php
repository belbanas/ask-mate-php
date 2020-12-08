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
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Email</label>
                        <input type="email" class="form-control" id="username" placeholder="Enter your email"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>

@endsection