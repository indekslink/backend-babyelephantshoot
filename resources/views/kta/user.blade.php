@extends('layouts.main',['title'=> 'Kartu Tanda Anggota'])


@section('content')
<div class="container-fluid px-4">
    <h1 class="my-4">Kartu Tanda Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class=" fw-bold text-dark text-decoration-none" href="/">Home</a></li>
        <li class="breadcrumb-item active">Kartu Tanda Anggota</li>
    </ol>


    @if(cekKelengkapanData() || $users->kta->download == '0')

    <div class="text-center fs-3">

        {{cekKelengkapanData() ? 'Silahkan Lengkapi data Anda terlebih dahulu.' :'Anda belum diizinkan mendownload KTA, Silahkan hubungi Admin.' }}
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <img src="/assets/images/locked.png" alt="" class="img-fluid">
        </div>
    </div>
    @else
    <small class="d-block text-info mb-4"><strong>Mohon Maaf</strong> , apabila nama Anda terlalu panjang maka sistem otomatis <strong>memotong</strong> karakter nama Anda !</small>
    <a href="{{route('stream.kta','potrait')}}" class="btn btn-primary btn-block me-4 mb-4" target="_blank"><i class="fas fa-id-card-alt"></i> Download KTA Potrait</a>
    <a href="{{route('stream.kta','landscape')}}" class="btn btn-primary btn-block mb-4" target="_blank"><i class="fas fa-address-card"></i> Download KTA Landscape</a>
    @endif


</div>
@endsection