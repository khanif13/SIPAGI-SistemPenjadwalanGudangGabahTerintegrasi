@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengajuan Jadwal</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/jadwal">Jadwal</a></li>
                    <li class="breadcrumb-item active">Pengajuan Jadwal</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row" style="width: 100%; height: 100%;">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Isi Data Anda</h5>
                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('jadwal.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Pengirim</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ ucfirst($user->name) }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gudang" class="col-sm-2 col-form-label">Gudang</label>
                                    <div class="col-sm-10">
                                        <select name="gudang_id" id="gudang" class="form-control" required>
                                            <option value="">-- Pilih Gudang --</option>
                                            @foreach ($gudang as $gudang)
                                                <option value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="berat_gabah" class="col-sm-2 col-form-label">Berat Gabah</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" name="berat_gabah" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kadar_air" class="col-sm-2 col-form-label">Kadar Air</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" name="kadar_air" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_kirim" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Submit Form</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End General Form Elements -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
