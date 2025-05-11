@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Assign Manager ke Gudang</h1>
        </div>

        <section class="section">
            <div class="card p-4">
                <form action="{{ route('gudang.assign', $gudang->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="manager_id" class="form-label">Pilih Manager</label>
                        <select name="manager_id" id="manager_id" class="form-select" required>
                            <option value="">-- Pilih Manager --</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }} ({{ $manager->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </form>
            </div>
        </section>
    </main>
@endsection
