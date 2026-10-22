<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;

    protected $table = 'table_budget';

    protected $fillable = [
        'category_id',
        'account_id',
        'periode',
        'amount',
        'tanggal_mulai',
        'tanggal_akhir',
        'is_active',
    ];

    protected $casts = [
        'periode' => 'App\Enums\SharedEnum',
        'amount' => 'decimal:2',
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}