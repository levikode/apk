<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View; 

class UserController extends Controller
{
    // Fungsi untuk menampilkan daftar user
    public function index(): View
    {
        // Mengambil semua data user dari database dan mengirimkannya ke view 'user.index'
        return view('user.index', [
            "title" => "Data user", 
            "data" => User::all() 
        ]);
    }

    // Fungsi untuk menyimpan user baru
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form tambah user
        $request->validate([
            "name" => "required", 
            "email" => "required", 
            "password" => "required" 
        ]);
        
        // Melakukan hashing pada password sebelum disimpan ke database
        $password = Hash::make($request->password);

        // Menggabungkan hasil hash password ke dalam request yang akan disimpan
        $request->merge([
            "password" => $password
        ]);

        // Menyimpan data user yang baru ke database
        User::create($request->all());

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('user.index')->with('success', 'Data User Berhasil Ditambahkan');
    }

    // Fungsi untuk menampilkan form edit data User
    public function edit(User $user):View
    {
        return view('user.edituser',compact('user'))->with([
            "title" => "Ubah Data User",
        ]);
    }

    // Fungsi untuk memperbarui data User yang diedit
    public function update(User $user, Request $request):RedirectResponse
    {
        $request->validate([
            "name" => "required", 
            "email" => "required", 
            "password" => "required" 
        ]);
        if (empty($request['hp'])) {
            $request['hp']='null';
        if (empty($request['alamat'])) 
            $request['alamat']='null';
        }

        $user->update($request->all());
        return redirect()->route('user.index')->with('success','Data User Berhasil Diubah');
    }
    
    // Fungsi untuk menghapus data User
    public function destroy($id):RedirectResponse
    {
        User::where('id',$id)->delete();
        return redirect()->route('user.index')->with('error','Data User Berhasil Dihapus');
    }
}
