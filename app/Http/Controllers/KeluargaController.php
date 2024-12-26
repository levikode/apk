<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KeluargaController extends Controller
{
    // Fungsi untuk menampilkan data keluarga
    public function index()
    {
        return view('keluarga.index', [
            "title" => "keluarga",
            "data" => Keluarga::all()
        ]);
    }    

    // Fungsi untuk menampilkan form tambah data keluarga
    public function create():View
    {
        return view('keluarga.index')->with(["title" => "Tambah Data keluarga"]);
    }

    // Fungsi untuk menyimpan data keluarga yang ditambahkan
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
        ]);
        if (empty($request['hp'])) {
            $request['hp']='null';
        if (empty($request['alamat'])) 
            $request['alamat']='null';
        }

        keluarga::create($request->all());
        return redirect()->route('keluarga.index')->with('success','Data keluarga Berhasil Ditambahkan');
    }

    // Fungsi untuk menampilkan form edit data keluarga
    public function edit(Keluarga $keluarga):View
    {
        return view('keluarga.editkeluarga',compact('keluarga'))->with([
            "title" => "Ubah Data keluarga",
        ]);
    }

    // Fungsi untuk memperbarui data keluarga yang diedit
    public function update(Keluarga $keluarga, Request $request):RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
        ]);
        if (empty($request['hp'])) {
            $request['hp']='null';
        if (empty($request['alamat'])) 
            $request['alamat']='null';
        }

        $keluarga->update($request->all());
        return redirect()->route('keluarga.index')->with('updated','Data keluarga Berhasil Diubah');
    }

    // Fungsi untuk menghapus data keluarga
    public function destroy($id):RedirectResponse
    {
        Keluarga::where('id',$id)->delete();
        return redirect()->route('keluarga.index')->with('deleted','Data Pegawai Berhasil Dihapus');
    }

}



