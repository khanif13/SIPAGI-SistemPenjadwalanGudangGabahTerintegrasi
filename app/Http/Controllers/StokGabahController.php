<?php

namespace App\Http\Controllers;

use App\Models\StokGabah;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class StokGabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokGabah = StokGabah::with(['gudang', 'user'])->get();

        return view('stok-gabah', compact('stokGabah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gudang_id' => 'required|exists:gudangs,id',
            'tanggal_masuk' => 'required|date',
            'berat_gabah' => 'required|numeric',
            'kadar_air' => 'required|numeric',
        ]);

        StokGabah::create([
            'gudang_id' => $request->gudang_id,
            'user_id' => auth()->id(),
            'tanggal_masuk' => $request->tanggal_masuk,
            'berat_gabah' => $request->berat_gabah,
            'kadar_air' => $request->kadar_air,
        ]);

        return redirect()->back()->with('success', 'Stok gabah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StokGabah $stokGabah)
    {
        $stokGabah->delete();
        return redirect()->route('stok-gabah.index')->with('success', 'Data berhasil dihapus.');
    }
}
