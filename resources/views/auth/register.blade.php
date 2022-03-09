@extends('layouts.auth')

@section('title','Register')


@section('content')

<div class="card-body">
    <div class="display-2 font-logo text-center mb-4">Register</div>
    <form action="/register" method="post" onsubmit="loadingAction('.submit-form')">
        @csrf
        @error('credentials')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror

        <div class="form-floating mb-3">
            <input type="text" onkeyup="makeUsername(this,'input#username')" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" autocomplete="off" id="name" placeholder="name@example.com">
            <label for="name">Nama Lengkap</label>
            @error('nama_lengkap')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" id="username" placeholder="name@example.com">
            <label for="username">Username</label>
            @error('username')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating input-toggle-password mb-3">
            <input type="password" class=" form-control target-toggle-multiple-password @error('password') is-invalid @enderror" name="password" autocomplete="off" id="password" placeholder="name@example.com">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class=" form-control target-toggle-multiple-password @error('konfirmasi_password') is-invalid @enderror" name="password_confirmation" autocomplete="off" id="confirm_password" placeholder="name@example.com">
            <label for="confirm_password">Konfirmasi Password</label>
            @error('konfirmasi_password')
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
        <button class="btn-danger btn w-100 mb-3 submit-form" type="submit">Daftar</button>
        <div class="text-center">
            Sudah punya akun ? <a href="/login" class="text-danger text-decoration-none fw-bold">Login disini</a>
        </div>
    </form>
</div>

@endsection