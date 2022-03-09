<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

function isAdmin()
{
    return auth()->user()->role_id == '1';
}
function isAtlit()
{
    return auth()->user()->role_id == '2';
}
function isMember()
{
    return auth()->user()->role_id == '3';
}
function dateReadable($date)
{
    return  Carbon::parse($date)->diffForhumans();
}
function colorRole($role = null)
{
    $role = $role ?? auth()->user()->role->name;
    $data = [
        ['name' => 'admin', 'color' => 'primary'],
        ['name' => 'member', 'color' => 'warning'],
        ['name' => 'atlit', 'color' => 'danger'],
    ];
    $result = collect($data)->firstWhere('name', $role);
    return $result['color'];
}
function maskEmail($email)
{
    $explode = explode('@', $email);
    $mail = $explode[0];
    $ext = $explode[1];
    return Str::mask($mail, '*', 3) . '@' . $ext;
}
function cekKelengkapanData()
{
    $notNull = true;
    $userLogin = auth()->user();
    if ($userLogin->field_user) {
        $notNull = false;
        if (
            !$userLogin->email ||
            !$userLogin->field_user->no_ktp ||
            !$userLogin->field_user->alamat ||
            !$userLogin->field_user->no_hp ||
            !$userLogin->field_user->foto
        ) {
            $notNull = true;
        }
    }

    return $notNull;
}

function dateKTA($input)
{

    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $data = Carbon::parse($input)->format('d/n/Y');
    $date = explode('/', $data);
    $tgl = $date[0];
    $bln = $bulan[$date[1] - 1];
    $thn = $date[2];

    return $tgl . ' ' . $bln . ' ' . $thn;
}
