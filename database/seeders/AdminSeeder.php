<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrCreate — aman dijalankan berulang kali saat re-deploy Railway
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@pelanglor.desa.id'],
            [
                'name'     => 'Admin Desa',
                'password' => Hash::make('password'),
            ]
        );
    }
}
