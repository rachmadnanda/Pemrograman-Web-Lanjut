<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'event_id' => 1,
                'name' => 'Budi Santoso',
                'phone' => '08123456789',
                'category' => 'VIP',
                'qr_token' => 'QR-BUDI-001', // Token unik untuk scan
                'checkin_status' => false,
                'souvenir_status' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_id' => 1,
                'name' => 'Siti Aminah',
                'phone' => '08987654321',
                'category' => 'Reguler',
                'qr_token' => 'QR-SITI-002',
                'checkin_status' => false,
                'souvenir_status' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('guests')->insert($data);
    }
}