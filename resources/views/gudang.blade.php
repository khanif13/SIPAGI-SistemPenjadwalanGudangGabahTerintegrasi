@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Gudang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Data Gudang</h5>
                                <a href="{{ route('gudang.create') }}" class="btn btn-primary mt-3">Tambah Gudang</a>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>Nama Gudang</b></th>
                                        <th><b>Kapasitas</b></th>
                                        <th><b>Jumlah Jadwal</b></th>
                                        <th><b>Total Gabah Masuk</b></th>
                                        <th><b>Aksi</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gudang as $index => $p)
                                        <tr>
                                            <th scope="row"><b>{{ $index + 1 }}</b></th>
                                            <td>{{ $p->nama_gudang }}</td>
                                            <td>{{ $p->kapasitas }}</td>
                                            <td>{{ $p->jadwals_count }}</td>
                                            <td>{{ $p->isi_gabah }} Kg</td>
                                            <td class="text-end">
                                                @if (Gate::allows('assign-manager'))
                                                    <a href="{{ route('gudang.assign.form', $p->id) }}"
                                                        class="btn btn-sm btn-warning" style="min-width: 100px">Manager</a>
                                                @endif
                                                @if (Gate::allows('update-gudang'))
                                                    <a href="{{ route('gudang.edit', $p->id) }}"
                                                        class="btn btn-primary btn-sm" style="min-width: 100px">
                                                        Edit
                                                    </a>
                                                @endif
                                                @if (Gate::allows('delete-gudang'))
                                                    <form action="{{ route('gudang.destroy', $p->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            style="min-width: 100px"
                                                            onclick="return confirm('Yakin ingin menghapus gudang ini?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
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
