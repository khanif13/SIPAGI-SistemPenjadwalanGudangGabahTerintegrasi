@extends('layouts.app')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Jadwal</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Data Jadwal</h5>
                                @if (Gate::allows('create-jadwal'))
                                    <a href="{{ route('jadwal.create') }}" class="btn btn-primary mt-3">Tambah Jadwal</a>
                                @endif
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>Nama Pengirim</b></th>
                                        <th><b>Gudang</b></th>
                                        <th>Tanggal Kirim</th>
                                        <th>Berat</th>
                                        <th>Kadar Air</th>
                                        <th>Status</th>
                                        @if (Auth::user()->role_id == '1')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($jadwal as $index => $p)
                                        <tr>
                                            <th scope="row"><b>{{ $index + 1 }}</b></th>
                                            <td>{{ ucfirst($p->user->name) }}</td>
                                            <td>{{ $p->gudang->nama_gudang ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_kirim)->format('d/m/Y') }}</td>
                                            <td>{{ $p->berat_gabah }} Kg</td>
                                            <td>{{ $p->kadar_air }}%</td>
                                            <td>
                                                @switch($p->status)
                                                    @case('diajukan')
                                                        <span class="badge bg-secondary">Diajukan</span>
                                                    @break

                                                    @case('diterima')
                                                        <span class="badge bg-success">Diterima</span>
                                                    @break

                                                    @case('ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @break

                                                    @case('selesai')
                                                        <span class="badge bg-primary">Selesai</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-warning">Unknown</span>
                                                @endswitch
                                            </td>

                                            <td class="text-end">
                                                @if ($p->status == 'diajukan' && Gate::allows('update-jadwal'))
                                                    <form action="{{ route('jadwal.updateStatus', $p->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="diterima">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            style="min-width: 100px">Terima</button>
                                                    </form>
                                                @endif

                                                @if ($p->status == 'diajukan' && Gate::allows('update-jadwal'))
                                                    <form action="{{ route('jadwal.updateStatus', $p->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="ditolak">
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            style="min-width: 100px">Tolak</button>
                                                    </form>
                                                @endif

                                                @if ($p->status == 'diterima' && Gate::allows('update-jadwal'))
                                                    <form action="{{ route('jadwal.updateStatus', $p->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="selesai">
                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            style="min-width: 100px">Selesai</button>
                                                    </form>
                                                @endif

                                                @if (Gate::allows('delete-jadwal') && $p->status == 'diajukan')
                                                    <form action="{{ route('jadwal.destroy', $p->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            style="min-width: 100px"
                                                            onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert
                                                            alert-success alert-dismissible fade show mx-3 mt-3"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
