<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, // Milik Admin
                'title' => 'Pernikahan Impian',
                'groom_name' => 'Dilan',
                'bride_name' => 'Ancika',
                'event_date' => '2026-10-10', // Contoh tanggal acara
                'location_name' => 'Hotel Tugu Malang',
                'location_maps_url' => 'https://maps.app.goo.gl/fA5oweSQumqeq8fP7',
                'theme' => 'Rustic Minimalist',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('events')->insert($data);
    }
}