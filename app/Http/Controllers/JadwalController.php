<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Jadwal;
use App\Models\StokGabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == '1' || $user->role_id ==   '2') {
            $jadwal = Jadwal::all();
        } else {
            $jadwal = Jadwal::where('user_id', $user->id)->get();
        }

        return view('jadwal', compact('jadwal'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gudang = Gudang::all();
        $user = Auth::user();
        $jadwal = Jadwal::all();
        return view('create-jadwal', compact('gudang', 'user', 'jadwal'));
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

        $gudang = Gudang::find($request->gudang_id);

        // Hitung total berat gabah yang sudah dijadwalkan (belum selesai)
        $totalJadwal = Jadwal::where('gudang_id', $gudang->id)
            ->whereIn('status', ['diajukan', 'diterima'])
            ->sum('berat_gabah');

        $sisaKapasitas = $gudang->kapasitas - $totalJadwal;

        if ($request->berat_gabah > $sisaKapasitas) {
            return redirect()->back()->with('error', 'Kapasitas gudang tidak mencukupi.');
        }

        Jadwal::create([
            'user_id' => auth()->id(),
            'gudang_id' => $request->gudang_id,
            'berat_gabah' => $request->berat_gabah,
            'kadar_air' => $request->kadar_air,
            'tanggal_kirim' => $request->tanggal_kirim,
            'status' => 'diajukan',
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

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak,selesai',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        $jadwal->status = $request->status;
        $jadwal->save();

        if (in_array($request->status, ['diterima', 'selesai'])) {
            $stokExists = StokGabah::where([
                'gudang_id' => $jadwal->gudang_id,
                'user_id' => $jadwal->user_id,
                'tanggal_masuk' => $jadwal->tanggal_kirim,
                'berat_gabah' => $jadwal->berat_gabah,
            ])->exists();

            if (! $stokExists) {
                StokGabah::create([
                    'gudang_id'     => $jadwal->gudang_id,
                    'user_id'       => $jadwal->user_id,
                    'tanggal_masuk' => $jadwal->tanggal_kirim,
                    'berat_gabah'   => $jadwal->berat_gabah,
                    'kadar_air'     => $jadwal->kadar_air,
                ]);
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Status pengajuan diperbarui.');
    }


    public function selesai($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status == 'diterima') {
            return $this->updateStatus(new Request(['status' => 'selesai']), $jadwal);
        }

        return redirect()->route('jadwal.index')->with('error', 'Jadwal tidak dapat ditandai selesai.');
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
    public function update(Request $request, string $id) {}


    public function terima($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return $this->updateStatus(new Request(['status' => 'diterima']), $jadwal);
    }

    public function tolak($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->status = 'ditolak';
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal ditolak.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Data berhasil dihapus.');
    }
}
