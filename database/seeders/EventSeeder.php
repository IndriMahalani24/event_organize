<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('event')->insert([
            [
                'name' => 'Workshop Laravel Dasar',
                'description' => '',
                'event_date' => '2025-07-10',
                'event_time' => '09:00:00',
                'location' => 'Aula A Kampus',
                'speaker' => 'Budi Santoso',
                'poster' => 'poster1.jpg',
                'registration_fee' => 25000,
                'max_participants' => 100,
                'status' => 'active',
                'users_iduser' => 4
            ],
            [
                'name' => 'Seminar AI dan Data Science',
                'description' => '',
                'event_date' => '2025-08-15',
                'event_time' => '13:00:00',
                'location' => 'Aula B Kampus',
                'speaker' => 'Dewi Ramadhani',
                'poster' => 'poster2.jpg',
                'registration_fee' => 50000,
                'max_participants' => 150,
                'status' => 'active',
                'users_iduser' => 4
            ],
            [
                'name' => 'Pelatihan UI/UX untuk Mahasiswa',
                'description' => '',
                'event_date' => '2025-09-01',
                'event_time' => '10:00:00',
                'location' => 'Lab Komputer 1',
                'speaker' => 'Rizky Ahmad',
                'poster' => 'poster3.jpg',
                'registration_fee' => 30000,
                'max_participants' => 80,
                'status' => 'inactive',
                'users_iduser' => 4
            ]
        ]);
    }
}
