<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'stok_id' => $i,
                'supplier_id' => ceil($i / 5), // supplier 1 (brg 1-5), supplier 2 (brg 6-10), supplier 3 (brg 11-15)
                'barang_id' => $i,
                'user_id' => 1, // Diinput oleh Admin
                'stok_tanggal' => now(),
                'stok_jumlah' => 100,
            ];
        }
        DB::table('t_stok')->insert($data);
    }
}