<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string',
        ]);
    
        // Inisialisasi query builder dari model Pegawai
        $query = Pegawai::query();
    
        // Filter berdasarkan pencarian NIP
        if ($request->filled('search')) {
            $query->where('nip', 'like', '%' . $request->search . '%');
        }
    
        // Filter berdasarkan tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
    
        // Paginasi hasil data
        $pegawai = $query->paginate(10);
    
        // Kirim data ke view
        return view('laporan.laporan', [
            'data' => $pegawai,
            'pegawai' => $pegawai,
            'title' => 'Pegawai',
            'search' => $request->search,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    public function exportPdf(Request $request)
{
    $request->validate([
        'start_date' => 'nullable|date|before_or_equal:today',
        'end_date' => 'nullable|date|after_or_equal:start_date|before_or_equal:today',
        'search' => 'nullable|string|max:255',
    ]);
    

    // Inisialisasi query builder
    $query = Pegawai::query();

    // Filter berdasarkan NIP
    if ($request->filled('search')) {
        $query->where('nip', 'like', '%' . $request->search . '%');
    }

    // Filter berdasarkan tanggal
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }
    


    // Ambil data berdasarkan filter
    $pegawai = $query->get();

    // Generate PDF
    $pdf = Pdf::loadView('laporan.pdf', compact('pegawai'));
    $pdf->setPaper('A4', 'landscape');

    // Download PDF
    return $pdf->download('laporan.pdf');
}

}
