<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->load('role');
        if ($user->hasRole('admin')) {
            $gudang = Gudang::withCount('jadwals')
                ->withSum('stokGabahs', 'berat_gabah')
                ->get();
        } else if ($user->hasRole('manager')) {
            $gudang = $user->gudangs()
                ->withCount('jadwals')
                ->withSum('stokGabahs', 'berat_gabah')
                ->get();
        } else {
            $gudang = collect();
        }

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

    public function assignManagerForm($id)
    {
        $gudang = Gudang::findOrFail($id);

        // Ambil user dengan role MANAGER (misal role_id = 2)
        $managers = User::whereHas('role', function ($q) {
            $q->where('name', 'manager'); // atau pakai role_id == 2 sesuai implementasi kamu
        })->get();

        return view('gudang-manager', compact('gudang', 'managers'));
    }

    public function assignManager(Request $request, $id)
    {
        $request->validate([
            'manager_id' => 'required|exists:users,id',
        ]);

        $gudang = Gudang::findOrFail($id);
        $managerId = $request->manager_id;

        // Role_id 2 misal = MANAGER
        $gudang->users()->syncWithoutDetaching([
            $managerId => ['role_id' => 2]
        ]);

        return redirect()->route('gudang.index')->with('success', 'Manager berhasil ditambahkan!');
    }
}
