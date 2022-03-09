@extends('layouts.main',['title'=> 'Users'])


@section('content')
<div class="container-fluid px-4">
    <h1 class="my-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class=" fw-bold text-dark text-decoration-none" href="/">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>


    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Bergabung Tgl</th>
                    <th>Detail</th>
                </tr>

            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        @if($user->role_id == '2')
                        <button class="btn btn-sm text-capitalize btn-info">{{$user->role->name}}</button>
                        @else
                        <button class="btn btn-sm text-capitalize btn-warning">{{$user->role->name}}</button>
                        @endif
                    </td>
                    <td>{{dateReadable($user->created_at)}}</td>
                    <td><a href="{{route('users.show',$user->username)}}" class="btn btn-sm  btn-info">
                            <i class="far fa-eye"></i>
                        </a></td>
                </tr>

                @empty

                <tr>
                    <th colspan="5" class="text-center">Data Masih Kosong</th>
                </tr>

                @endforelse
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection