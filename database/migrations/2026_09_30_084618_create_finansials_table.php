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

        Schema::create('finansials', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('trip_id')->nullable()->constrained('table_trip')->nullOnDelete();
            $table->date('transaksi_date')->nullable();
            $table->string('transaksi_type')->nullable();
            $table->string('asset_type');
            $table->foreignId('goal_id')->nullable()->constrained('table_goal')->nullOnDelete();
            $table->string('periode');
            $table->foreignId('account_id')->nullable()->constrained('table_account')->nullOnDelete();
            $table->foreignId('account_to_id')->nullable()->constrained('table_account')->nullOnDelete();
            $table->foreignId('debt_id')->nullable()->constrained('table_debt')->nullOnDelete();
            $table->string('status');
            $table->string('type');
            $table->string('mekanisme_pembayaran');
            $table->decimal('total_cost', 15, 2);
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
        Schema::dropIfExists('finansials');
    }
};
