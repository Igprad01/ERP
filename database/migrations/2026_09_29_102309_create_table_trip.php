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
        Schema::create('table_trip', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->String('aktivitas');
            $table->string('lokasi');
            $table->unsignedBigInteger('category_id');
            $table->string('orang');
            $table->text('catatan')->nullable();
            $table->string('status');
            $table->timestamps();


            
        });

        Schema::table('table_trip', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('table_category')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_trip');
    }
};
