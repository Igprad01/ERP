<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('table_category', function (Blueprint $table) {
            // Menambahkan kolom type setelah kolom nama
            $table->string('type')->default('expense')->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_category', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
