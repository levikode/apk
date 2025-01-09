<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\Keluarga;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\Agama;
use App\Models\Unitkerja;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class PegawaiController extends Controller
{

public function exportPdf()
{
    $dataPegawai = Pegawai::all();

    foreach ($dataPegawai as $pegawai) {
        $encryptedPath = storage_path('app/public/foto/pegawai/' . $pegawai->foto); // Path file terenkripsi

        if (file_exists($encryptedPath)) {
            // Baca file terenkripsi dan dekripsi isinya
            $encryptedContent = file_get_contents($encryptedPath);
            $decryptedContent = Crypt::decrypt($encryptedContent);

            // Konversi ke Base64
            $pegawai->image_base64 = 'data:image/jpeg;base64,' . base64_encode($decryptedContent);
        } else {
            $pegawai->image_base64 = null; // Jika file tidak ditemukan
        }
    }

    // Generate PDF
    $pdf = Pdf::loadView('pegawai.pdf', compact('dataPegawai'));
    $pdf->setPaper('A4', 'landscape');

    return $pdf->download('data-pegawai.pdf');
}

    // Fungsi untuk menampilkan data pegawai
    public function index(Request $request)
    {
        $pegawai = Pegawai::all();

        $search = $request->input('search');

        $pegawai = Pegawai::when($search, function ($query, $search) {
        return $query->where('nip', 'like', '%' . $search . '%');
    })->paginate(5);

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
            "keluarga" => Keluarga::all(),
            "golongan" => Golongan::all(),
            "agama" => Agama::all(),
            "unitkerja" => Unitkerja::all(),
            "jabatan" => Jabatan::all()
        ]);
    }

    // Fungsi untuk menyimpan data pegawai yang ditambahkan
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "user_id" => "required",
            "nama" => "required",
            "nip" => "required|digits_between:6,16",
            "jeniskelamin" => "required",
            "tempatlahir" => "required",
            "usia" => "required",
            "masakerja" => "required",
            "golongan_id" => "required",
            "keluarga_id" => "required",
            "agama_id" => "required",
            "unitkerja_id" => "required",
            "jabatan_id" => "required",
            "tanggallahir" => "required",
            "alamat" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ]);

        $data = $request->all();

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
            "keluarga" => Keluarga::all(),
            "golongan" => Golongan::all(),
            "agama" => Agama::all(),
            "unitkerja" => Unitkerja::all(),
            "jabatan" => Jabatan::all()
        ]);
    }

    // Fungsi untuk memperbarui data pegawai yang diedit
    public function update(Pegawai $pegawai, Request $request): RedirectResponse
    {
        $request->validate([
            "user_id" => "required",
            "nama" => "required",
            "nip" => "required|digits_between:6,16",
            "jeniskelamin" => "required",
            "tempatlahir" => "required",
            "usia" => "required",
            "masakerja" => "required",
            "golongan_id" => "required",
            "keluarga_id" => "required",
            "agama_id" => "required",
            "unitkerja_id" => "required",
            "jabatan_id" => "required",
            "tanggallahir" => "required",
            "alamat" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ]);

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
