<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // firstOrCreate — hanya insert jika belum ada, tidak update
            // Tidak akan pernah throw UniqueConstraintViolationException
            \App\Models\User::firstOrCreate(
                ['email' => 'admin@pelanglor.desa.id'],
                [
                    'name'     => 'Admin Desa',
                    'password' => Hash::make('password'),
                ]
            );
        } catch (\Exception $e) {
            // Admin sudah ada, abaikan error
            \Log::info('AdminSeeder: Admin already exists, skipping. ' . $e->getMessage());
        }
    }
}
