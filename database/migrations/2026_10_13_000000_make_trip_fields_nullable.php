<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('table_trip', function (Blueprint $table) {
            $table->string('lokasi')->nullable()->change();
            $table->string('orang')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('table_trip', function (Blueprint $table) {
            $table->string('lokasi')->nullable(false)->change();
            $table->string('orang')->nullable(false)->change();
        });
    }
};
