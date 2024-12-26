<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unitkerja;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UnitkerjaController extends Controller
{
    // Fungsi untuk menampilkan data Unitkerja
    public function index()
    {
        // Mengambil semua data Unitkerja dari database
        return view('unitkerja.index', [
            "title" => "Unitkerja",
            "data" => Unitkerja::all()
        ]);
    }    

    // Fungsi untuk menampilkan form tambah data Unitkerja
    public function create():View
    {
        return view('unitkerja.index')->with(["title" => "Tambah Data Unitkerja"]);
    }

    // Fungsi untuk menyimpan data Unitkerja yang ditambahkan
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

        Unitkerja::create($request->all());
        return redirect()->route('unitkerja.index')->with('success','Data Unitkerja Berhasil Ditambahkan');
    }
    
    // Fungsi untuk menampilkan form edit data Unitkerja
    public function edit(Unitkerja $unitkerja):View
    {
        return view('unitkerja.editunitkerja',compact('unitkerja'))->with([
            "title" => "Ubah Data Unitkerja",
        ]);
    }

    // Fungsi untuk memperbarui data Unitkerja yang diedit
    public function update(Unitkerja $unitkerja, Request $request):RedirectResponse
    {
        $request->validate([
            "nama"=>"required",
        ]);
        if (empty($request['hp'])) {
            $request['hp']='null';
        if (empty($request['alamat'])) 
            $request['alamat']='null';
        }

        $unitkerja->update($request->all());
        return redirect()->route('unitkerja.index')->with('updated','Data Unitkerja Berhasil Diubah');
    }

    // Fungsi untuk menghapus data Unitkerja
    public function destroy($id):RedirectResponse
    {
        Unitkerja::where('id',$id)->delete();
        return redirect()->route('unitkerja.index')->with('deleted','Data Pegawai Berhasil Dihapus');
    }

}



