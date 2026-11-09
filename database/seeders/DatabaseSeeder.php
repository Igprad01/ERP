<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat role Admin jika belum ada
        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['deskripsi' => 'Administrator dengan akses penuh ke seluruh modul sistem.']
        );

        // 2. Buat akun User Admin untuk login
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
