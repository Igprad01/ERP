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
        Schema::create('table_debt', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // pihak/keterangan ("Pak Budi", "Bank Mandiri")
            $table->string('type'); // hutang/piutang
            $table->decimal('total_amount', 15, 2);
            $table->decimal('sisa_amount', 15, 2);
            $table->date('tanggal');
            $table->date('jatuh_tempo')->nullable();
            $table->string('status')->default('active'); // goalStatus_finansial: active=berjalan, complete=lunas
            $table->foreignId('akun_id')->constrained('table_account')->nullOnDelete();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_debt');
    }
};