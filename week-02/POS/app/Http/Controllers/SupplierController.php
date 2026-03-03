<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        // 1. Insert Data (Hanya dijalankan sekali, beri komentar atau hilangkan setelah berhasil)
        /*
        $data = [
            'supplier_kode' => 'SUP04',
            'supplier_nama' => 'CV Bumi Nusantara',
            'supplier_alamat' => 'Sidoarjo'
        ];
        DB::table('m_supplier')->insert($data);
        */

        // 2. Update Data (Beri komentar atau hilangkan jika tidak digunakan)
        /*
        $row = DB::table('m_supplier')->where('supplier_kode', 'SUP04')->update(['supplier_nama' => 'PT Bumi Nusantara']);
        */
        
        // 3. Delete Data (Beri komentar atau hilangkan jika tidak digunakan)
        /*
        $row = DB::table('m_supplier')->where('supplier_kode', 'SUP04')->delete();
        */

        // 4. Retrieve / Read Data
        $data = DB::table('m_supplier')->get();

        return view('supplier', ['data' => $data]);
    }
}