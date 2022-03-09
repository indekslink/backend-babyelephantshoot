@extends('layouts.main',['title'=> 'Kartu Tanda Anggota'])


@section('content')
<div class="container-fluid px-4">
    <h1 class="my-4">Kartu Tanda Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class=" fw-bold text-dark text-decoration-none" href="/">Home</a></li>
        <li class="breadcrumb-item active">Kartu Tanda Anggota</li>
    </ol>
    <div class="alert alert-success alert-dismissible d-none fade message-download" role="alert">
        Izin Download KTA berhasil di <strong></strong> untuk <strong></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK KTA</th>
                    <th>Masa Berlaku</th>

                    <th class="text-center">Status Data</th>
                    <th class="text-center">Izin Download</th>
                </tr>

            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->kta->nik_kta}}</td>
                    <td>{{dateKTA($user->kta->masa_berlaku)}}</td>

                    <td class="text-center">
                        @if($user->field_user)

                        <button type="button" class="btn btn-success btn-sm "> Lengkap</button>

                        @else

                        <button type="button" class="btn btn-danger btn-sm ">Belum Lengkap</button>
                        @endif
                    </td>

                    <td class="text-center kolom-action-download">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                            <input type="radio" onclick="izinDownload(this,'0','{{base64_encode($user->username)}}')" data-checked="{{$user->kta->download == 0 ? 'yes' : 'no' }}" class="btn-check" name="izin-{{$user->username}}" id="no-{{$loop->iteration}}" autocomplete="off" {{$user->kta->download == '0' ? 'checked' : ''}}>
                            <label class="btn btn-outline-danger" for="no-{{$loop->iteration}}"><i class="fas fa-lock"></i></label>



                            <input type="radio" onclick="izinDownload(this,'1','{{base64_encode($user->username)}}')" data-checked="{{$user->kta->download == 1 ? 'yes' : 'no' }}" class="btn-check" name="izin-{{$user->username}}" id="yes-{{$loop->iteration}}" autocomplete="off" {{$user->kta->download == '1' ? 'checked' : ''}}>
                            <label class="btn btn-outline-success" for="yes-{{$loop->iteration}}"><i class="fas fa-lock-open"></i></label>
                        </div>
                    </td>
                </tr>

                @empty

                <tr>
                    <th colspan="6" class="text-center">Data Masih Kosong</th>
                </tr>

                @endforelse
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('script')

<script>
    function izinDownload(element, bool, username) {
        let isChecked = element.getAttribute('data-checked');
        if (isChecked == 'yes') {
            return;
        }

        element.setAttribute('data-checked', 'yes')

        const parent = element.parentElement;
        parent.classList.toggle('loading');

        parent.prepend(templateLoading());

        const data = {
            download: bool,
            username
        }




        fetch('/api/change-download', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {

                const name = element.getAttribute('name');
                document.querySelectorAll(`input[name="${name}"]`).forEach(ele => {
                    if (ele.getAttribute('id') != element.getAttribute('id')) {
                        ele.setAttribute('data-checked', 'no')
                    }
                })

                parent.children[0].remove()
                parent.classList.toggle('loading')

                showAlert(data);

            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }


    function templateLoading() {
        let parent = document.createElement('div');
        parent.classList.add('parent-spinner')

        let subChild1 = document.createElement('div');
        ['spinner-border', 'text-light'].forEach(e => subChild1.classList.add(e));

        let subChild2 = document.createElement('span');
        subChild2.classList.add('visually-hidden');
        subChild2.textContent = "Loading...";


        subChild1.append(subChild2)
        parent.append(subChild1);

        return parent;

    }

    function showAlert(data) {
        const alert = document.querySelector('.alert.message-download');
        alert.children[0].textContent = data.msg
        alert.children[1].textContent = data.name
        alert.classList.remove('d-none');
        alert.classList.add('show');

        setTimeout(() => {
            alert.classList.remove('show')
            alert.classList.add('d-none')
        }, 3000);
    }
</script>
@endsection


@section('css')

<style>
    .kolom-action-download .btn-group::after {
        position: absolute;
        content: "";
        inset: -5px;
        border-radius: 5px;
        opacity: 0;

        background-color: rgba(0, 0, 0, 0.6);
        z-index: -2;
    }

    .kolom-action-download .btn-group.loading::after {
        opacity: 1 !important;
        z-index: 2 !important;
    }

    .kolom-action-download .btn-group.loading .parent-spinner {
        opacity: 1 !important;
        z-index: 3 !important;
    }

    .kolom-action-download .btn-group .parent-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -3;

        opacity: 0;
    }
</style>
@endsection