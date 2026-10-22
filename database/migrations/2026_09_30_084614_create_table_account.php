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
        Schema::create('table_account', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('type'); // cash/bank/ewallet/credit_card/savings/investment/other
            $table->decimal('saldo', 15, 2)->default(0);
            $table->decimal('limit_kredit', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('table_account');
    }
};