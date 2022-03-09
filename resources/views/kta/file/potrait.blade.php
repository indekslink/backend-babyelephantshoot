@extends('kta.file.template')

@section('content')
<div class="parent">
    <div class="izin">AHU-0014381.AH.01.07.TAHUN 2021</div>
    <div class="user-img" style="background-image: url({{public_path('assets/images/users/'.$user->field_user->foto)}});"></div>
    <!-- <img src="{{public_path('assets/images/users/'.$user->field_user->foto)}}" class="user-img" alt=""> -->
    <div class="informasi">

        <div class="top">
            <span class="qr-code">
                <img src="data:image/png;base64, {!! $qrcode !!}">
            </span>
            <div class="user">
                <div class="name">
                    {{$nama_lengkap}}
                </div>
                <div class="nik">
                    {{$user->kta->nik_kta}}
                </div>
            </div>
            <div class="exp">
                Berlaku s/d {{dateKTA($user->kta->masa_berlaku)}}
            </div>
        </div>


    </div>
    <img src="{{ public_path('assets/images/potrait.jpg') }}" class="image" alt="desain-gambar">
</div>
@endsection

@section('css')
<style>
    img.image {
        position: absolute;
        width: 50%;
        top: 0;
        bottom: 0;
        left: 50%;
        height: 100%;
        transform: translateX(-50%);
    }

    .parent {
        position: relative;
        width: 100%;
        height: 100%;
        font-family: Arial, Helvetica, sans-serif;
    }

    .parent .izin,
    .parent .informasi,
    .parent .user-img {
        position: absolute;
        z-index: 2;
    }

    .parent .izin {
        width: 50%;
        left: 50%;
        top: 190px;
        transform: translateX(-50%);
        color: white;
        font-weight: bold;
        text-align: center;

        font-size: 13px;
    }

    .parent .user-img {
        width: 160px;
        left: 50%;
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3), -5px 0px 5px rgba(0, 0, 0, 0.3);
        height: 180px;
        border-radius: 10px;
        top: 210px;
        background-color: red;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        object-fit: cover;
        transform: translateX(-50%);

    }

    span.qr-code {
        display: block;
        padding: 7px;
        margin-top: 3px;
        background-color: white;
        float: left;
        margin-right: 10px;
        margin-left: 15%;
    }

    /* 
        .parent .informasi .top {

            position: absolute;
            transform: translateX(-50%);
            left: 50%;
            top: 0;
            width: 70%;
            margin: 0 auto;
        } */

    .parent .informasi {
        /* color: white; */
        width: 50%;

        color: white;
        left: 50%;
        top: 395px;
        transform: translateX(-50%);
    }

    .parent .informasi .top {
        /* background-color: yellow; */
        width: 80%;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .informasi .top .user {
        font-weight: bold;
        font-size: 17px;
        text-transform: uppercase;
    }

    .informasi .user .nik {
        font-size: 10px;
    }

    .informasi .exp {
        clear: both;
        margin-top: 5px;
        width: 100%;

        text-align: center;
        font-size: 9px;
        font-weight: bold;
    }
</style>
@endsection