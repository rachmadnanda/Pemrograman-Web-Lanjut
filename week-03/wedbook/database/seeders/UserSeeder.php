<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin Wedbook',
                'email' => 'admin@wedbook.com',
                'password' => Hash::make('12345678'), // Password dienkripsi
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Panitia Penerima Tamu',
                'email' => 'scanner@wedbook.com',
                'password' => Hash::make('12345678'),
                'role' => 'scanner',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('users')->insert($data); // Memasukkan data ke tabel users
    }
}