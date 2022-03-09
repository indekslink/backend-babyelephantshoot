@extends('layouts.auth',['scan'=>'true'])

@section('title','Expired KTA')

@section('content')
<div class="relative-content text-center pb-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <img src="/assets/images/failed.png" alt="" class="img-fluid ">

        </div>
    </div>

    <div class="display-3 font-logo fw-bold text-center mb-2">KTA is <span class="text-danger font-logo">Expired</span></div>
    <div class="text-muted fs-5 mb-2">with name</div>
    <div class="fw-bold text-uppercase fs-1 lh-sm">{{$user->name}}</div>
    <div class=" text-uppercase fs-4 mb-4">{{$user->kta->nik_kta}}</div>

    <a href="https://babyelephantshoot.com" class="btn btn-danger rounded-pill btn-lg">Back to Home</a>
</div>
@endsection