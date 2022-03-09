@extends('layouts.main',['title'=> $user->name])


@section('content')
<div class="container-fluid px-4">
    <h1 class="my-4">Users</h1>
    <ol class="breadcrumb mb-4">
        @if(auth()->user()->username == $user->username)
        <li class="breadcrumb-item"><a class=" fw-bold text-dark text-decoration-none" href="/">Home</a></li>
        <li class="breadcrumb-item active">Akun Saya</li>
        @else
        <li class="breadcrumb-item"><a class=" fw-bold text-dark text-decoration-none" href="/">Home</a></li>
        <li class="breadcrumb-item"><a class=" fw-bold text-dark text-decoration-none" href="/users">Users</a></li>
        <li class="breadcrumb-item active">{{$user->username}}</li>
        @endif
    </ol>

    <div class="row gy-4 justify-content-center">
        @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Sukses</h4>
                <p>{{session('success')}}</p>


                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <div class="col-md-6 col-lg-4 col-9">
            <div class="card">
                <img src="/assets/images/users/{{$user->field_user && $user->field_user->foto ? $user->field_user->foto : 'default.png'}}" class="card-img-top img-fluid preview-img" alt="user-image">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">{{$user->name}}</h5>
                    <p class="card-text mb-3">
                        <button class="btn btn-sm text-capitalize btn-{{colorRole($user->role->name)}}">{{$user->role->name}}</button>
                    </p>
                    @if($user->role->name != 'admin')
                    <p class="card-text mb-3 text-muted">
                        Register at : {{dateReadable($user->created_at)}}
                    </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-12">
            @if(auth()->user()->role->name =='admin')

            @if(auth()->user()->username == $user->username)


            <div class="card">
                <div class="card-header">
                    Update Informasi
                </div>
                <div class="card-body">
                    <form action="{{route('update.autentikasi')}}" method="post" onsubmit="loadingAction('.submit-form-user-autentikasi')" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username </label>
                            <input type="text" name="username" onkeyup="makeUsername(this,'#username')" onkeypress="makeUsername(this,'#username')" onkeydown="makeUsername(this,'#username')" class="form-control @error('username') is-invalid @enderror" id="username" value="{{old('username') ?? $user->username}}">

                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_baru" class="form-label">Password Baru </label>
                            <input type="password" name="password_baru" class="form-control  target-toggle-multiple-password @error('password_baru') is-invalid @enderror" id="password_baru">

                            @error('password_baru')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_baru_confirmation" class="form-label">Konfirmasi Password Baru </label>
                            <input type="password" name="password_baru_confirmation" class="form-control  target-toggle-multiple-password @error('password_baru_confirmation') is-invalid @enderror" id="password_baru_confirmation">

                            @error('password_baru_confirmation')
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

                        <button class="btn btn-primary float-end submit-form-user-autentikasi" type="submit">Simpan</button>
                    </form>
                </div>
            </div>

            @else
            <div class="card">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <button class="nav-link {{count($errors->all()) > 0 ? '' : 'active' }}" id="nav-info-user-tab" data-bs-toggle="tab" data-bs-target="#nav-info-user" type="button" role="tab" aria-controls="nav-info-user" aria-selected="true">Infomasi User</button>
                        <button class="nav-link {{count($errors->all()) > 0 ? 'active' : '' }}" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Update Profile</button>

                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade {{count($errors->all()) > 0 ? '' : ' show active' }}" id="nav-info-user" role="tabpanel" aria-labelledby="nav-info-user-tab">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-6">
                                        <strong> Nama Lengkap</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {{$user->name}}
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-6">
                                        <strong>Email</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {{$user->email ?? '-'}}
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-6">
                                        <strong>No KTP</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {{$user->field_user ? $user->field_user->no_ktp : '-'}}
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-6">
                                        <strong>No HP</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {{$user->field_user ? $user->field_user->no_hp : '-'}}
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-6">
                                        <strong>Alamat</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {{$user->field_user ? $user->field_user->alamat : '-'}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{count($errors->all()) > 0 ? 'show active' : '' }}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card border-0">

                            <div class="card-body">
                                <form action="{{route('users.update',$user->username)}}" method="post" onsubmit="loadingAction('.submit-form-user')" enctype="multipart/form-data">
                                    @method("PUT")
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap<sup class="fw-bold text-danger">*</sup> </label>
                                        <input required type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" value="{{old('nama_lengkap') ?? $user->name}}">

                                        @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<sup class="fw-bold text-danger">*</sup> </label>


                                        <input required type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email') ?? $user->email}}">


                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_ktp" class="form-label">No KTP<sup class="fw-bold text-danger">*</sup> </label>
                                        <input required type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" value="{{ (old('no_ktp') ? old('no_ktp') : ($user->field_user ? $user->field_user->no_ktp : '')) }}">
                                        @error('no_ktp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No HP<sup class="fw-bold text-danger">*</sup> </label>
                                        <input required type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ (old('no_hp') ? old('no_hp') : ($user->field_user ? $user->field_user->no_hp : '')) }}">
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat<sup class="fw-bold text-danger">*</sup> </label>

                                        <textarea required class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{(old('alamat') ? old('alamat') : ($user->field_user ? $user->field_user->alamat : ''))}}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 d-none parent-preview">
                                            <img src="" alt="preview-img" class="img-fluid preview-img">
                                        </div>
                                        <div class="col-12 parent-input">
                                            <div>
                                                <label for="foto" class="form-label">Ubah Foto<sup class="fw-bold text-danger">*</sup></label>
                                                <input {{$user->field_user && $user->field_user->foto ? '' :'required'}} type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewImage(event,'.preview-img')" id="foto" value="{{old('foto') ? old('foto') :  $user->field_user ? $user->field_user->foto : ''}}" accept=".jpg, .png, .jpeg">
                                                <input type="hidden" name="default_foto" value="{{$user->field_user ? $user->field_user->foto : ''}}">
                                                @error('foto')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if($user->field_user && $user->field_user->foto)
                                    <div class="form-check mb-3 text-start">
                                        <input class="form-check-input ubah-gambar" type="checkbox" id="ubah-gambar">
                                        <label class="form-check-label" for="ubah-gambar">
                                            Ingin ubah gambar ?
                                        </label>
                                    </div>
                                    @endif
                                    <button class="btn btn-primary float-end submit-form-user" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            @endif
            @else


            <div class="card">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <button class="nav-link {{ !$errors->first('username') && !$errors->first('password_baru') ? 'active' : ''}}" id="nav-info-user-tab" data-bs-toggle="tab" data-bs-target="#nav-info-user" type="button" role="tab" aria-controls="nav-info-user" aria-selected="true">Profil</button>
                        <button class="nav-link {{ $errors->first('username') || $errors->first('password_baru')  ? 'active' : ''}}" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Autentikasi</button>

                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade {{ !$errors->first('username') && !$errors->first('password_baru') ? 'show active' : ''}} " id="nav-info-user" role="tabpanel" aria-labelledby="nav-info-user-tab">
                        <div class="card border-0">

                            <div class="card-body">
                                <form action="{{route('users.update',$user->username)}}" method="post" onsubmit="loadingAction('.submit-form-user')" enctype="multipart/form-data">
                                    @method("PUT")
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap<sup class="fw-bold text-danger">*</sup> </label>
                                        <input required type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" value="{{old('nama_lengkap') ?? $user->name}}">

                                        @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<sup class="fw-bold text-danger">*</sup> </label>


                                        <input required type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email') ?? $user->email}}">


                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_ktp" class="form-label">No KTP<sup class="fw-bold text-danger">*</sup> </label>
                                        <input required type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" value="{{ (old('no_ktp') ? old('no_ktp') : ($user->field_user ? $user->field_user->no_ktp : '')) }}">
                                        @error('no_ktp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No HP<sup class="fw-bold text-danger">*</sup> </label>
                                        <input required type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ (old('no_hp') ? old('no_hp') : ($user->field_user ? $user->field_user->no_hp : '')) }}">
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat<sup class="fw-bold text-danger">*</sup> </label>

                                        <textarea required class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{(old('alamat') ? old('alamat') : ($user->field_user ? $user->field_user->alamat : ''))}}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 d-none parent-preview">
                                            <img src="" alt="preview-img" class="img-fluid preview-img">
                                        </div>
                                        <div class="col-12 parent-input">
                                            <div>
                                                <label for="foto" class="form-label">Ubah Foto<sup class="fw-bold text-danger">*</sup></label>
                                                <input {{$user->field_user && $user->field_user->foto ? '' :'required'}} type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewImage(event,'.preview-img')" id="foto" value="{{old('foto') ? old('foto') :  $user->field_user ? $user->field_user->foto : ''}}" accept=".jpg, .png, .jpeg">
                                                <input type="hidden" name="default_foto" value="{{$user->field_user ? $user->field_user->foto : ''}}">
                                                @error('foto')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if($user->field_user && $user->field_user->foto)
                                    <div class="form-check mb-3 text-start">
                                        <input class="form-check-input ubah-gambar" type="checkbox" id="ubah-gambar">
                                        <label class="form-check-label" for="ubah-gambar">
                                            Ingin ubah gambar ?
                                        </label>
                                    </div>
                                    @endif
                                    <button class="btn btn-primary float-end submit-form-user" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ $errors->first('username') || $errors->first('password_baru') ? 'show active' : ''}} " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card border-0">

                            <div class="card-body">
                                <form action="{{route('update.autentikasi')}}" method="post" onsubmit="loadingAction('.submit-form-user-autentikasi')" enctype="multipart/form-data">
                                    @method("PUT")
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username </label>
                                        <input type="text" name="username" onkeyup="makeUsername(this,'#username')" onkeypress="makeUsername(this,'#username')" onkeydown="makeUsername(this,'#username')" class="form-control @error('username') is-invalid @enderror" id="username" value="{{old('username') ?? $user->username}}">

                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_baru" class="form-label">Password Baru </label>
                                        <input type="password" name="password_baru" class="form-control  target-toggle-multiple-password @error('password_baru') is-invalid @enderror" id="password_baru">

                                        @error('password_baru')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_baru_confirmation" class="form-label">Konfirmasi Password Baru<sup class="fw-bold text-danger">*</sup> </label>
                                        <input type="password" name="password_baru_confirmation" class="form-control  target-toggle-multiple-password @error('password_baru_confirmation') is-invalid @enderror" id="password_baru_confirmation">

                                        @error('password_baru_confirmation')
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

                                    <button class="btn btn-primary float-end submit-form-user-autentikasi" type="submit">Simpan</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function lowerCase(e) {
        e.value = e.value.toLowerCase();
    }
    const ubahGambar = document.getElementById('ubah-gambar');
    if (ubahGambar) {
        const fieldGambar = document.querySelector('input[name="foto"]');
        ubahGambar.addEventListener('change', function(e) {
            const {
                checked
            } = e.target;
            if (checked) {
                fieldGambar.setAttribute('required', checked);
            } else {
                fieldGambar.removeAttribute('required');
            }

        })
    }
</script>
@endsection