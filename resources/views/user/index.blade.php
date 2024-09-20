@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Data Pengguna</h3>
    @if (can('create-user'))
        <div class="mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
        </div>
    @endif
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>--</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis kelamin</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="width: 35px">
                                        <img class="img-fluid" src="{{ $user->avatar() }}">
                                    </td>
                                    <td nowrap>{{ $user->nip ? $user->nip : '-' }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->position ? $user->position->name : '-' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td nowrap>
                                        <a href="{{ route('user.show', ['user' => $user]) }}"
                                            class="btn btn-sm btn-light-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
