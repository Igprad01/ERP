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
        Schema::create('table_budget', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('table_category')->nullOnDelete();
            $table->foreignId('account_id')->constrained('table_account')->nullOnDelete();
            $table->string('periode'); // daily/weekly/monthly/yearly
            $table->decimal('amount', 15, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_budget');
    }
};