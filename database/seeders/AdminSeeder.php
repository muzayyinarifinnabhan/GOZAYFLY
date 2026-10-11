<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder admin default:
 *   email: admin@gozay.id
 *   password: admin123
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@gozay.id'],
            [
                'name' => 'Administrator GoZay',
                'phone' => '6281234567890',
                'password' => Hash::make('admin123'),
                'is_super' => true,
            ]
        );
    }
}