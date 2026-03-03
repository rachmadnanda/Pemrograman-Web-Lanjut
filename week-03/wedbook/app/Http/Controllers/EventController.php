<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib dipanggil untuk DB Facade

class EventController extends Controller
{
    public function index()
    {
        //DB::insert('insert into events(user_id, groom_name, bride_name, event_date, location_name, created_at) values(?, ?, ?, ?, ?, ?)', [1, 'Romeo', 'Juliet', '2026-12-12', 'Gedung Kesenian', now()]);
        //return 'Insert data baru berhasil';
        
        // $row = DB::update('update events set theme = ? where bride_name = ?', ['Classic Romantic', 'Juliet']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';
        
        // $row = DB::delete('delete from events where bride_name = ?', ['Juliet']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // Menampilkan data
        $data = DB::select('select * from events');
        return view('event', ['data' => $data]);
    }
}
