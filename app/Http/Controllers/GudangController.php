<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gudang = Gudang::all();
        return view('gudang', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('create-gudang', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
        ]);

        $gudang = Gudang::create([
            'nama_gudang' => $request->nama_gudang,
            'kapasitas' => $request->kapasitas,
        ]);

        // Gunakan role_id dari tabel roles
        $roleId = 1;
        $gudang->users()->attach(Auth::id(), [
            'role_id' => $roleId,
        ]);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('gudang.show', compact('gudang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('create-gudang', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
        ]);

        $gudang = Gudang::findOrFail($id);
        $gudang->update([
            'nama_gudang' => $request->nama_gudang,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus!');
    }
}
