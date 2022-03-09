@extends('kta.file.template')

@section('content')
<div class="parent">


    <div class="izin">AHU-0014381.AH.01.07.TAHUN 2021</div>

    <div class="user">
        <div class="name">
            {{$nama_lengkap}}
        </div>
        <div class="nik">
            {{$user->kta->nik_kta}}
        </div>
    </div>
    <span class="qr-code">
        <img src="data:image/png;base64, {!! $qrcode !!}">
    </span>

    <div class="exp">
        Berlaku s/d {{dateKTA($user->kta->masa_berlaku)}}
    </div>


    <img src="{{ public_path('assets/images/landscape-2.JPEG') }}" class="image" alt="desain-gambar">
</div>
@endsection

@section('css')
<style>
    .parent {
        font-family: Arial, Helvetica, sans-serif;
        position: relative;
        color: white;
    }

    .parent .image {
        width: 100%;
    }

    .parent .qr-code {
        display: inline-block;
        background: white;
        padding: 7px;
        left: 400px;
    }

    .parent .user,
    .parent .izin,
    .parent .exp,
    .parent .qr-code {
        position: absolute;

        top: 160px;

        z-index: 2;
    }

    .parent .user {
        left: 235px;

        display: inline-block;
        text-align: right;
        font-weight: bold;
        width: 150px;
        text-transform: uppercase;
    }

    .parent .user .name {
        font-size: 17px;

    }

    .parent .user .nik {
        font-size: 10px;

    }

    .parent .izin {
        top: 264px;
        left: 90px;
        font-weight: bold;
        font-size: 10px;
    }

    .parent .exp {
        top: 264px;
        left: 335px;
        font-weight: bold;
        font-size: 10px;
    }
</style>
@endsection