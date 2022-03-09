@extends('layouts.main',['title'=> 'Home'])


@section('content')
<div class="container-fluid px-4">
    <!-- <h1 class="my-4">Home</h1> -->
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home</li>
    </ol> -->

    @if(auth()->user()->role->name != 'admin')
    @if(cekKelengkapanData())
    <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Perhatian!</h4>
        <p>Mohon segera lengkapi data Anda , agar KTA(Kartu Tanda Anggota) dapat segera Anda dapatkan</p>
        <hr>
        <a href="{{route('users.show',auth()->user()->username)}}" class="btn btn-danger">Lengkapi Sekarang</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @endif
    <div class="display-5 fw-bold my-5 text-center">Selamat Datang , {{auth()->user()->name}}</div>


    @if(auth()->user()->role->name == 'admin')
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="card card-bg-icon p-3 bg-primary text-light">
                <i class="fas fa-users"></i>
                <div class="fs-4">Jumlah Users</div>
                <div class="fs-1 fw-bold">{{\App\Models\User::where('role_id','!=', '1')->count()}}</div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection