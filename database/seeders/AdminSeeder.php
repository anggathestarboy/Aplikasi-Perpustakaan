<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data admin
        Admin::create([
            'username' => 'admin123',
            'password' => Hash::make('adminpassword')
        ]);

        Admin::create([
            'username' => 'admin456',
            'password' => Hash::make('adminpassword123')
        ]);

        // Tambahkan lebih banyak data sesuai kebutuhan
    }
}

