<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 1
        ]);
        User::create([
            'id' => 2,
            'name' => 'enji',
            'email' => 'enji123',
            'password' => Hash::make('enji123'),
            'role_id' => 2
        ]);
    }
}
