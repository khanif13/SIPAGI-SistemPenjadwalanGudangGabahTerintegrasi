<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::with(['user', 'gudang'])->get();
        return view('jadwal', compact('jadwal'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gudang = Gudang::all();
        $user = Auth::user();
        return view('create-jadwal', compact('gudang', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gudang_id' => 'required|exists:gudangs,id',
            'berat_gabah' => 'required|numeric',
            'kadar_air' => 'required|numeric',
            'tanggal_kirim' => 'required|date',
        ]);

        Jadwal::create([
            'user_id' => auth()->id(),
            'gudang_id' => $request->gudang_id,
            'berat_gabah' => $request->berat_gabah,
            'kadar_air' => $request->kadar_air,
            'tanggal_kirim' => $request->tanggal_kirim,
            'status' => 'diajukan   ',
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    public function updateStatus(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $jadwal->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pengajuan diperbarui.');
    }

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
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Data berhasil dihapus.');
    }

    public function terima($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->status = 'diterima';
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal diterima.');
    }

    public function tolak($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->status = 'ditolak';
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal ditolak.');
    }
}
