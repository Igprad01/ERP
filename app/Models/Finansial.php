<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finansial extends Model
{
    use SoftDeletes;

    protected $table = 'finansials';

    protected $fillable = [
        'reference_number',
        'trip_id',
        'transaksi_date',
        'transaksi_type',
        'asset_type',
        'goal_id',
        'periode',
        'account_id',
        'account_to_id',
        'debt_id',
        'status',
        'type',
        'mekanisme_pembayaran',
        'total_cost',
        'catatan',
    ];

    protected $casts = [
        'transaksi_type' => 'App\Enums\TransaksiType',
        'periode' => 'App\Enums\SharedEnum',
        'status' => 'App\Enums\Status',
        'total_cost' => 'decimal:2',
        'transaksi_date' => 'date',
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function accountTo(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_to_id');
    }

    public function debt(): BelongsTo
    {
        return $this->belongsTo(Debt::class);
    }
}