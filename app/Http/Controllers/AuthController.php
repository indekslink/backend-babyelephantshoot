<?php

namespace App\Http\Controllers;

use App\Models\KTA;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {

        $attempt = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($attempt)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back()->withErrors([
            'credentials' => 'Username atau Password Anda salah !'
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {

        $request->validate([
            'nama_lengkap' => ['required', 'max:100', function ($attr, $value, $fail) {
                if (!preg_match('/^[\pL\s]+$/u', $value)) {
                    $fail('nama lengkap hanya boleh menggunakan huruf.');
                }
            }],
            'username' => ['required', 'unique:users,username', function ($attr, $value, $fail) {
                if (!preg_match('/^\S*$/u', $value)) {
                    $fail($attr . ' tidak boleh menggunakan spasi.');
                }
            }],
            'password' => [
                'required', 'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()

            ],

        ]);

        DB::transaction(function () use ($request) {
            // cek terlebih dahulu jumlah user yang sudah terdaftar
            $current_users = $this->count_current_users();


            // buat masa berlaku kta
            $masa_berlaku =  $this->masa_berlaku();

            // create data user
            $user = User::create([
                'name' => $request->nama_lengkap,
                'username' => $request->username,
                'role_id' => 3, // set default role id
                'password' => Hash::make($request->password),

            ]);


            // create kta id
            $user->kta()->create([
                'nik_kta' => $current_users,
                'masa_berlaku' => $masa_berlaku,
                'download' => false
            ]);

            Auth::login($user);
        });
        return redirect()->route('home')->with('success', 'Akun berhasil dibuat');
    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function formatKTA($data_dinamis)
    {
        $data_dinamis++;
        return '000' . $data_dinamis . '/BES.031.01.02/' . date('Y');
    }
    public function masa_berlaku()
    {
        // format tahun
        $count =  1;
        $now = Carbon::now();
        $addExpired = $now->addYear($count);
        return  $addExpired;
    }

    public function count_current_users()
    {
        $users = User::where('role_id', '!=', '1')->count();
        return $this->formatKTA($users);
    }
    function send_otp(Request $request)
    {
        return response()->json($request->all());
    }

    function update_autentikasi(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'username' => [
                'nullable',
                function ($attr, $value, $fail) {
                    if (!preg_match('/^\S*$/u', $value)) {
                        $fail($attr . ' tidak boleh menggunakan spasi.');
                    }
                }, Rule::unique('users', 'username')->ignore($user->id),
            ],
            'password_baru' => [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()

            ]

        ]);

        if (($request->username && $request->username != $user->username)  ||
            $request->password_baru
        ) {
            $user->update(
                [
                    'username' => $request->username ?? $user->username,
                    'password' => $request->password_baru ? Hash::make($request->password_baru) : $user->password
                ]
            );
            Auth::logout();
            return redirect('/');
        }

        return redirect()->back()->with('success', 'Berhasil tidak merubah data Autentikasi');
    }
}
