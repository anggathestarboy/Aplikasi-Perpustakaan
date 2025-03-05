<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->timestamp('returned_at')->nullable()->after('due_at'); // Menambahkan kolom returned_at
        });
    }
    
    public function down()
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn('returned_at'); // Menghapus kolom returned_at
        });
    }
    
};
