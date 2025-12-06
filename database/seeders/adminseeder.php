<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@stmikbjb.ac.id',
            'username' => 'superadmin',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        Admin::create([
            'name' => 'Admin PMB',
            'email' => 'admin@stmikbjb.ac.id',
            'username' => 'adminpmb',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}