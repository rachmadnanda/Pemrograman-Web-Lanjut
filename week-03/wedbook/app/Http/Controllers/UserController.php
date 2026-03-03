<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        /*
        $data = [
            'name' => 'Keluarga Mempelai',
            'email' => 'keluarga@wedbook.com',
            'password' => Hash::make('12345'),
            'role' => 'scanner'
        ];
        UserModel::insert($data);
        */

        // $data = ['name' => 'Keluarga Inti'];
        // UserModel::where('email', 'keluarga@wedbook.com')->update($data);

        $user = UserModel::all(); // Mengambil semua data dari tabel users
        return view('user', ['data' => $user]);
    }
}