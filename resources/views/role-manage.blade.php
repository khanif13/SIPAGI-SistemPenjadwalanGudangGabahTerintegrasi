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
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('role-manage.update', $user->id) }}" method="POST"
                                            class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="form-control form-control-sm me-2">
                                                <option value="admin" {{ $user->role->name == 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="manager_gudang"
                                                    {{ $user->role->name == 'manager_gudang' ? 'selected' : '' }}>Manager
                                                    Gudang
                                                </option>
                                                <option value="user"
                                                    {{ $user->role->name == 'petani' ? 'selected' : '' }}>
                                                    Petani</option>
                                            </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
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
