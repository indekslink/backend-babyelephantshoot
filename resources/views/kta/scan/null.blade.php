@extends('layouts.auth',['scan'=>'true'])

@section('title','User Tidak Ditemukan')

@section('content')
<div class="relative-content text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <img src="/assets/images/404.png" alt="" class="img-fluid ">

        </div>
    </div>
    <div class="display-3 font-logo fw-bold text-center mb-4">User Tidak Ditemukan</div>

    <a href="https://babyelephantshoot.com" class="btn btn-danger rounded-pill btn-lg">Back to Home</a>
</div>
@endsection