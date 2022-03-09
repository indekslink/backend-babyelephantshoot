<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('cekRole:admin', ['except' => [
            'show', 'update'
        ]]);
    }
    public function index()
    {

        $users = User::where('role_id', '!=', '1')->latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        if (
            auth()->user()->role->name != 'admin' && $user->username != auth()->user()->username
        ) {
            return redirect('/');
        }
        // dd($user->field_user ? $user->field_user->no_ktp  : '') ;
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'nama_lengkap' => ['sometimes', 'required', function ($attr, $value, $fail) {
                if (!preg_match('/^[\pL\s]+$/u', $value)) {
                    $fail('nama lengkap hanya boleh menggunakan huruf.');
                }
            }],
            'email' => ['sometimes', 'required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'no_ktp' => 'sometimes|required|numeric',
            'no_hp' => 'sometimes|required|numeric|digits_between:11,13',
            'alamat' => 'sometimes|required|min:10',
            'foto' => 'sometimes|required|mimes:jpg,png,jpeg'
        ]);

        DB::transaction(function () use ($user, $request) {
            $user->name = $request->nama_lengkap;
            $user->email = $request->email;
            $user->save();

            $nama_foto = $request->default_foto;

            if ($request->hasFile('foto')) {
                //jika foto sudah ada

                $file = $request->file('foto');
                // $original_name = strtolower(trim($file->getClientOriginalName()));
                $ext = $file->getClientOriginalExtension();


                $nama_foto = time() . rand(100, 999) . '.' . $ext;

                if (($user->field_user && $user->field_user->foto) && $user->field_user->foto != $nama_foto) {
                    unlink('assets/images/users/' . $user->field_user->foto);
                }

                $file->move('assets/images/users/', $nama_foto);
            }

            $user->field_user()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'no_ktp' => $request->no_ktp,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'foto' => $nama_foto,
                ]
            );
        });

        return redirect()->back()->with('success', 'Data profil berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function akun(User $user)
    {
        dd($user);
    }
}
