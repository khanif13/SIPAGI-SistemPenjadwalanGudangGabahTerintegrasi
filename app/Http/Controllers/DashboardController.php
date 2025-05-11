<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\Gudang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with(['user', 'gudang'])->get();
        $jumlahPetani = User::where('role_id', '3')->count();
        $totalGabahMasuk = Jadwal::sum('berat_gabah');
        $gudangTersedia = Gudang::count();

        return view('dashboard', compact('jadwal', 'jumlahPetani', 'totalGabahMasuk', 'gudangTersedia'));
    }
}
