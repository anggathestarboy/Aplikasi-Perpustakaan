<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Memanggil seeder untuk user dan admin
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
