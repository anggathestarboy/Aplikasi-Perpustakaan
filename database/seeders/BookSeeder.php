<?php

// database/seeders/BookSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Learn Laravel',
            'author' => 'John Doe',
            'publisher' => 'Tech Publisher',
            'stock' => 10,
        ]);

        Book::create([
            'title' => 'Mastering PHP',
            'author' => 'Jane Doe',
            'publisher' => 'Code Press',
            'stock' => 5,
        ]);
    }
}
