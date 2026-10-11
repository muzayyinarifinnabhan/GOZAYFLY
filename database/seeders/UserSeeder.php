<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder user demo (sudah terverifikasi):
 *   email: user@gozay.id
 *   password: password
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'user@gozay.id'],
            [
                'name' => 'Penumpang Demo',
                'nik' => '3201012307950001',
                'phone' => '6281234500001',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
    }
}