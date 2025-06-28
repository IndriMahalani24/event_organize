<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        // Users
        DB::table('users')->insert([
            [
                'name' => 'Member Test',
                'email' => 'member@example.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tim Keuangan',
                'email' => 'keuangan@example.com',
                'password' => Hash::make('password'),
                'role' => 'keuangan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Panitia Event',
                'email' => 'panitia@example.com',
                'password' => Hash::make('password'),
                'role' => 'panitia',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Events
        DB::table('event')->insert([
            [
                'name' => 'Workshop Laravel',
                'event_date' => '2025-07-20 09:00:00',
                'location' => 'Aula Kampus A',
                'speaker' => 'Budi Santoso',
                'poster' => 'poster1.jpg',
                'registration_fee' => 25000,
                'max_participants' => 100,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Seminar AI Mahasiswa',
                'event_date' => '2025-08-15 13:00:00',
                'location' => 'Ruang 101',
                'speaker' => 'Dewi Ramadhani',
                'poster' => 'poster2.jpg',
                'registration_fee' => 50000,
                'max_participants' => 80,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
