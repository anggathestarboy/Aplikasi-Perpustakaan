<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data user
        User::create([
            'username' => 'user123',
            'password' => Hash::make('password')
        ]);

        User::create([
            'username' => 'user456',
            'password' => Hash::make('password123')
        ]);

        // Tambahkan lebih banyak data sesuai kebutuhan
    }
}

