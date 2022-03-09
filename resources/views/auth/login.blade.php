@extends('layouts.auth')

@section('title','Login')


@section('content')

<div class="card-body">
    <div class="display-2 font-logo text-center mb-4">Login</div>
    <form action="/login" method="post" onsubmit="loadingAction('.submit-form')">
        @csrf

        @error('credentials')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror

        <div class="form-floating mb-3">
            <input value="{{old('username')}}" type="text" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" id="username" placeholder="name@example.com">
            <label for="username">Username</label>

            @error('username')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class=" form-floating mb-3">
            <input type="password" class="form-control target-toggle-multiple-password @error('password') is-invalid @enderror" name="password" autocomplete="off" id="password" placeholder="name@example.com">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-check mb-3 text-start">
            <input class="form-check-input toggle-multiple-password" type="checkbox" id="toggle-password">
            <label class="form-check-label" for="toggle-password">
                Show Password
            </label>
        </div>
        <button class=" btn-danger btn w-100 mb-3 submit-form" type="submit">Masuk</button>
        <div class="text-center">
            Belum punya akun ? <a href="/register" class="text-danger text-decoration-none fw-bold">Daftar disini</a>
        </div>
    </form>
</div>

@endsection