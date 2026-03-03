<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
        /*
        $data = [
            'event_id' => 1,
            'name' => 'Tamu Tambahan',
            'qr_token' => 'QR-TAMU-003',
            'created_at' => now()
        ];
        DB::table('guests')->insert($data);
        return 'Insert data baru berhasil';
        */

        // $row = DB::table('guests')->where('qr_token', 'QR-TAMU-003')->update(['category' => 'VVIP']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // $row = DB::table('guests')->where('qr_token', 'QR-TAMU-003')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // Menampilkan data
        $data = DB::table('guests')->get();
        return view('guest', ['data' => $data]);
    }
}