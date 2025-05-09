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
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Data Jadwal</h5>
                                <a href="{{ route('jadwal.create') }}" class="btn btn-primary mt-3">Tambah Jadwal</a>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>Nama Pengirim</b></th>
                                        <th><b>Gudang</b></th>
                                        <th>Tanggal Kirim</th>
                                        <th>Berat</th>
                                        <th>Kadar Air</th>
                                        <th>Status</th>
                                        @if (Auth::user()->role_id == '1')
                                            <th class="text-end">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($jadwal as $p)
                                        <tr>
                                            <td>{{ $p->user->name }}</td>
                                            <td>{{ $p->gudang->nama_gudang ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_kirim)->format('d/m/Y') }}</td>
                                            <td>{{ $p->berat_gabah }} Kg</td>
                                            <td>{{ $p->kadar_air }}%</td>
                                            <td>{{ ucfirst($p->status) }}</td>

                                            @if (Auth::user()->role_id == '1')
                                                <td class="text-end">
                                                    @if ($p->status == 'diajukan')
                                                        <form action="{{ route('jadwal.terima', $p->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Terima</button>
                                                        </form>

                                                        <form action="{{ route('jadwal.tolak', $p->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-warning btn-sm">Tolak</button>
                                                        </form>
                                                    @endif

                                                    <form action="{{ route('jadwal.destroy', $p->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
