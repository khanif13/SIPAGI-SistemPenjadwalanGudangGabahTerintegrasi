@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datatables</h5>
                            <p>Add lightweight datatables to your project with using the <a
                                    href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                    DataTables</a> library. Just add <code>.datatable</code> class name to any table you
                                wish to conver to a datatable. Check for <a
                                    href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more
                                    examples</a>.</p>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th>
                                            <b>Gudang</b>
                                        </th>
                                        <th>Pengirim</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Berat Gabah</th>
                                        <th>Kadar Air</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stokGabah as $index => $stok)
                                        <tr>
                                            <td><b>{{ $index + 1 }}</b></td>
                                            <td>{{ $stok->gudang->nama_gudang ?? 'N/A' }}</td>
                                            <td>{{ $stok->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($stok->tanggal_masuk)->format('d/m/Y') }}</td>
                                            <td>{{ $stok->berat_gabah }} Kg</td>
                                            <td>{{ $stok->kadar_air }}%</td>
                                            <td class="text-end">
                                                <form action="{{ route('stok-gabah.destroy', $stok->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                                </form>
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
