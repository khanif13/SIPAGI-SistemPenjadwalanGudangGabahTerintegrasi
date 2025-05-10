@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gudang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/gudang">Gudang</a></li>
                    <li class="breadcrumb-item active">{{ isset($gudang) ? 'Edit Gudang' : 'Tambah Gudang' }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row" style="width: 100%; height: 100%;">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ isset($gudang) ? 'Edit Data Gudang' : 'Tambah Data Gudang' }}</h5>

                            <!-- General Form Elements -->
                            <form method="POST"
                                action="{{ isset($gudang) ? route('gudang.update', $gudang->id) : route('gudang.store') }}">
                                @csrf
                                @if (isset($gudang))
                                    @method('PUT')
                                @endif

                                <div class="row mb-3">
                                    <label for="nama_gudang" class="col-sm-3 col-form-label">Nama Gudang</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_gudang" class="form-control"
                                            value="{{ old('nama_gudang', isset($gudang) ? $gudang->nama_gudang : '') }}"
                                            required>
                                        @error('nama_gudang')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="kapasitas" class="col-sm-3 col-form-label">Kapasitas</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="kapasitas" step="0.01" class="form-control"
                                            value="{{ old('kapasitas', isset($gudang) ? $gudang->kapasitas : '') }}"
                                            required>
                                        @error('kapasitas')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($gudang) ? 'Update Gudang' : 'Simpan Gudang' }}
                                        </button>
                                        <a href="{{ route('gudang.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </form>
                            <!-- End General Form Elements -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
