<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User; 
use App\Models\Keluarga; 
use App\Models\Golongan;
use App\Models\Agama; 
use App\Models\Unitkerja;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    // Fungsi untuk menampilkan data pegawai
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', [
            "title" => "Pegawai",
            "data" => $pegawai
        ]);
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
            "unitkerja" => Unitkerja::all()
        ]);
    }

    // Fungsi untuk menyimpan data pegawai yang ditambahkan
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "user_id" => "required",
            "nama" => "required", 
            "nip" => "required", 
            "jeniskelamin" => "required", 
            "tempatlahir" => "required",
            "usia" => "required", 
            "masakerja" => "required", 
            "golongan_id" => "required",
            "keluarga_id" => "required", 
            "agama_id" => "required", 
            "unitkerja_id" => "required",
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
            "unitkerja" => Unitkerja::all()
        ]);
    }

    // Fungsi untuk memperbarui data pegawai yang diedit
    public function update(Pegawai $pegawai, Request $request): RedirectResponse
    {
        $request->validate([
            "user_id" => "required",
            "nama" => "required", 
            "nip" => "required", 
            "jeniskelamin" => "required", 
            "tempatlahir" => "required",
            "usia" => "required", 
            "masakerja" => "required", 
            "golongan_id" => "required",
            "keluarga_id" => "required", 
            "agama_id" => "required", 
            "unitkerja_id" => "required",
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

        return redirect()->route('pegawai.index')->with('updated', 'Data Pegawai Berhasil Diubah');
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

        return redirect()->route('pegawai.index')->with('deleted', 'Data Pegawai Berhasil Dihapus');
    }
}
