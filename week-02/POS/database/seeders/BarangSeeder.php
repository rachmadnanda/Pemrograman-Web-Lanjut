<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'barang_id' => $i,
                'kategori_id' => rand(1, 5),
                'barang_kode' => 'BRG' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'barang_nama' => 'Barang ' . $i,
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ];
        }
        DB::table('m_barang')->insert($data);
    }
}