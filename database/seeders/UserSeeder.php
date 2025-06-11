<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;    

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ini akan membuat user jika belum ada
        User::firstOrCreate(
            ['email' => 'test@example.com'], // Kondisi unik
            [
                'id' => 'AD-12000',
                'name' => 'Test User',
                'password' => Hash::make('qwerty123'),
                'role' => 1,
                'email_verified_at' => now(),
            ]
        );
    }
}
