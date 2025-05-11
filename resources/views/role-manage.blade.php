@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manajemen Role</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <h5 class="card-title">Daftar User & Role</h5>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role Saat Ini</th>
                                <th scope="col">Ubah Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $index => $user)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ ucfirst($user->name) }}</td>
                                    <td>{{ ucfirst($user->email) }}</td>
                                    <td>{{ ucfirst($user->role->name ?? '-') }}</td>
                                    <td>
                                        <form action="{{ route('role-manage.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="role_id" class="form-control form-control-sm">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                style="min-width: 100px">Update</button>
                                            </form>

                                            <form action="{{ route('role-manage.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    style="min-width: 100px">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </main>
@endsection
