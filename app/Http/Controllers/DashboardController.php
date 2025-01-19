<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Unitkerja;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Pegawai::all();  // Ambil data dari database
        $title = 'Dashboard';    // Set variabel title
        $user = User::all();
        $totalJabatan = Jabatan::count();        // Menghitung jumlah user
        $totalunitkerja = Unitkerja::count();        // Menghitung jumlah user

        return view('welcome', compact('data', 'title', 'user','totalJabatan','totalunitkerja'));
    }
  
    public function getChartData()
    {
        $totalPegawai = Pegawai::count();  // Menghitung jumlah pegawai
        $totalUser = User::count();        // Menghitung jumlah user

        return response()->json([
            'pegawai' => $totalPegawai,
            'user' => $totalUser,
        ]);
    
}
}
