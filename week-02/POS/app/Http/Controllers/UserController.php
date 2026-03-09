<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::with('level')->get(); 
        return view('user', ['data' => $user]);
    }

    // Method untuk menampilkan form tambah user
    public function tambah()
    {
        return view('user_tambah');
    }

    // Method untuk menyimpan data dari form ke database
    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password), // Perbaikan penting di sini!
            'level_id' => $request->level_id
        ]);

        return redirect('/user'); // Setelah simpan, lempar kembali ke halaman utama
    }

    // Method untuk menampilkan form ubah berdasarkan ID
    public function ubah($id)
    {
        $user = UserModel::find($id); // Mengambil data user berdasarkan ID
        return view('user_ubah', ['data' => $user]); // Melempar data ke view
    }

    // Method untuk menyimpan perubahan data ke database
    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id); // Cari dulu datanya
        
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password); 
        $user->level_id = $request->level_id;
        
        $user->save(); // Simpan perubahan ke database

        return redirect('/user'); // Kembali ke halaman utama
    }

    // Method untuk menghapus data dari database
    public function hapus($id)
    {
        $user = UserModel::find($id); // Cari data berdasarkan ID
        $user->delete(); // Hapus data dari database

        return redirect('/user'); // Kembali ke halaman utama
    }
}