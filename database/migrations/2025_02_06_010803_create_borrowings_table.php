<?php

// database/migrations/YYYY_MM_DD_create_borrowings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('borrowed_at');
            $table->timestamp('due_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
}
