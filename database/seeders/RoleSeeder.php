<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Panitia',
        ]);
        Role::create([
            'id' => 3,
            'name' => 'Keuangan',
        ]);
        Role::create([
            'id' => 4,
            'name' => 'Panitia',
        ]);
    }
}
