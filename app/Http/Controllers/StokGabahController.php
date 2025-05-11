<?php

namespace App\Http\Controllers;

use App\Models\StokGabah;
use App\Models\Gudang;
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
        $stok = new StokGabah();
        $stok->gudang_id = $request->gudang_id;
        $stok->berat_gabah = $request->berat_gabah;
        // simpan data stok
        $stok->save();

        // update isi gudang
        $gudang = Gudang::find($request->gudang_id);
        $gudang->terisi += $stok->berat_gabah;
        $gudang->save();

        return redirect()->route('stok-gabah.index')->with('success', 'Stok berhasil ditambahkan.');
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
    public function update(Request $request, $id)
    {
        $stok = StokGabah::findOrFail($id);
        $gudang = $stok->gudang;

        // Kurangi berat lama
        $gudang->terisi -= $stok->berat_gabah;

        // Update stok
        $stok->berat_gabah = $request->berat_gabah;
        $stok->save();

        // Tambah berat baru
        $gudang->terisi += $stok->berat_gabah;
        $gudang->save();

        return redirect()->route('stok-gabah.index')->with('success', 'Stok berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stok = StokGabah::findOrFail($id);
        $gudang = $stok->gudang;

        $gudang->terisi -= $stok->berat_gabah;
        $gudang->save();

        $stok->delete();

        return redirect()->route('stok-gabah.index')->with('success', 'Stok berhasil dihapus.');
    }
}
