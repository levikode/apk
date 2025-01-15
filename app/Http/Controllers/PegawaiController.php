<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Unitkerja;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class PegawaiController extends Controller
{

//     public function laporan(Request $request)
//     {
//         // Validasi input
//         $request->validate([
//             'start_date' => 'nullable|date',
//             'end_date' => 'nullable|date|after_or_equal:start_date',
//             'search' => 'nullable|string',
//         ]);
    
//         // Inisialisasi query builder dari model Pegawai
//         $query = Pegawai::query();
    
//         // Filter berdasarkan pencarian NIP
//         if ($request->filled('search')) {
//             $query->where('nip', 'like', '%' . $request->search . '%');
//         }
    
//         // Filter berdasarkan tanggal
//         if ($request->filled('start_date') && $request->filled('end_date')) {
//             $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
//         }
    
//         // Paginasi hasil data
//         $pegawai = $query->paginate(10);
    
//         // Kirim data ke view
//         return view('pegawai.laporan', [
//             'data' => $pegawai,
//             'pegawai' => $pegawai,
//             'title' => 'Pegawai',
//             'search' => $request->search,
//             'start_date' => $request->start_date,
//             'end_date' => $request->end_date,
//         ]);
//     }
    

//     public function exportPdf(Request $request)
// {
//     // Validasi input
//     $request->validate([
//         'start_date' => 'nullable|date',
//         'end_date' => 'nullable|date|after_or_equal:start_date',
//         'search' => 'nullable|string|max:255',
//     ]);

//     // Inisialisasi query builder
//     $query = Pegawai::query();

//     // Filter berdasarkan NIP
//     if ($request->filled('search')) {
//         $query->where('nip', 'like', '%' . $request->search . '%');
//     }

//     // Filter berdasarkan tanggal
//     if ($request->filled('start_date') && $request->filled('end_date')) {
//         $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
//     }

//     // Ambil data berdasarkan filter
//     $pegawai = $query->get();

//     // Generate PDF
//     $pdf = Pdf::loadView('pegawai.pdf', compact('pegawai'));
//     $pdf->setPaper('A4', 'landscape');

//     // Download PDF
//     return $pdf->download('pegawai.pdf');
// }


    // Fungsi untuk menampilkan data pegawai
    public function index(Request $request)
    {
        $pegawai = Pegawai::all();

        \Carbon\Carbon::setLocale('id');

        $search = $request->input('search');

        $pegawai = Pegawai::when($search, function ($query, $search) {
            return $query->where('nip', 'like', '%' . $search . '%');
        })->paginate(50);

        return view('pegawai.index', [
            "title" => "Pegawai",
            "data" => $pegawai
        ], compact('pegawai'));
    }

    // Fungsi untuk menampilkan form tambah data pegawai
    public function create(): View
    {
        return view('pegawai.create')->with([
            "title" => "Tambah Data Pegawai",
            "user" => User::all(),
            "unitkerja" => Unitkerja::all(),
            "jabatan" => Jabatan::all()
        ]);
    }

    // Fungsi untuk menyimpan data pegawai yang ditambahkan
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "user_id" => "required",
            "nama" => "required",
            "nip" => "required|digits_between:6,16",
            "jeniskelamin" => "required",
            "usia" => "required",
            "masakerja" => "required",
            "golongandarah" => "required",
            "statuskeluarga" => "required",
            "agama" => "required",
            "unitkerja_id" => "required",
            "jabatan_id" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required|date",
            "alamat" => "required",
            "tmt" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg|max:5048",
        ]);

        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'tanggal_lahir' => [
        //         'required',
        //         'date',
        //         'before:' . now()->subYears(17)->format('Y-m-d'), // Validasi minimal umur 17 tahun
        //     ],
        // ], [
        //     // Pesan error kustom (opsional)
        //     'tanggal_lahir.before' => 'Pegawai harus berusia minimal 17 tahun.',
        // ]);

        $validated['usia'] = \Carbon\Carbon::parse($validated['tanggal_lahir'])->age;
        $validated['masakerja'] = \Carbon\Carbon::parse($validated['tmt'])->age;


        // Gabungkan tempat dan tanggal lahir
        $ttl = $request->tempat_lahir . ', ' . $request->tanggal_lahir;

        // Data yang akan disimpan
        $data = $request->except(['tempat_lahir', 'tanggal_lahir']);
        $data['ttl'] = $ttl;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawai/foto', 'public');
        }


        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }

    // Fungsi untuk menampilkan form edit data pegawai
    public function edit(Pegawai $pegawai): View
    {
        return view('pegawai.edit', compact('pegawai'))->with([
            "title" => "Ubah Data Pegawai",
            "user" => User::all(),
            "unitkerja" => Unitkerja::all(),
            "jabatan" => Jabatan::all()
        ]);
    }

    // Fungsi untuk memperbarui data pegawai yang diedit
    public function update(Pegawai $pegawai, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "user_id" => "required",
            "nama" => "required",
            "nip" => "required|digits_between:6,16",
            "jeniskelamin" => "required",
            "usia" => "required",
            "masakerja" => "required",
            "golongandarah" => "required",
            "statuskeluarga" => "required",
            "agama" => "required",
            "unitkerja_id" => "required",
            "jabatan_id" => "required",
            "tempat_lahir" => "",
            "tanggal_lahir" => "",
            "alamat" => "required",
            "tmt" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg|max:5048",
        ]);
        // Validasi data
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'tanggal_lahir' => [
        //         'required',
        //         'date',
        //         'before:' . now()->subYears(17)->format('Y-m-d'),
        //     ],
        // ], [
        //     'tanggal_lahir.before' => 'Pegawai harus berusia minimal 17 tahun.',
        // ]);

        $validated['usia'] = \Carbon\Carbon::parse($validated['tanggal_lahir'])->age;
        $validated['masakerja'] = \Carbon\Carbon::parse($validated['tmt'])->age;

        // Data awal
        $ttl = $request->tempat_lahir . ', ' . $request->tanggal_lahir;

        // Pisahkan data berdasarkan koma
        $data = explode(', ', $ttl);

        // Pastikan array memiliki dua elemen
        $tempat_lahir = isset($data[0]) ? $data[0] : '';
        $tanggal_lahir = isset($data[1]) ? $data[1] : '';

        // Output hasil
        echo "Tempat Lahir: " . $tempat_lahir . "<br>";
        echo "Tanggal Lahir: " . $tanggal_lahir . "<br>";



        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $data['foto'] = $request->file('foto')->store('pegawai/foto', 'public');
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai Berhasil Diubah');
    }

    // Fungsi untuk menampilkan detail data pegawai
    public function show(): View
    {
        $pegawai = Pegawai::all();
        return view('pegawai.show')->with([
            "title" => "Tampil Data Pegawai",
            "data" => $pegawai
        ]);
    }

    // Fungsi untuk menghapus data pegawai
    public function destroy($id): RedirectResponse
    {
        $pegawai = Pegawai::findOrFail($id);

        // Hapus foto jika ada
        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('error', 'Data Pegawai Berhasil Dihapus');
    }
}
