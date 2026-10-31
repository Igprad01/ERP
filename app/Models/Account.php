<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $table = 'table_account';

    protected $fillable = [
        'nama',
        'type',
        'saldo_awal',
        'saldo',
        'limit_kredit',
        'is_active',
        'catatan',
    ];

    protected $casts = [
        'type' => 'App\Enums\AccountType_financial',
        'saldo_awal' => 'decimal:2',
        'saldo' => 'decimal:2',
        'limit_kredit' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function finances(): BelongsTo
    {
        return $this->belongsTo(Finansial::class, 'account_id');
    }
}
