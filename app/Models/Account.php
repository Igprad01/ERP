<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'table_account';

    protected $fillable = [
        'nama',
        'type',
        'saldo',
        'limit_kredit',
        'is_active',
        'catatan',
    ];

    protected $casts = [
        'type' => 'App\Enums\AccountType_financial',
        'saldo' => 'decimal:2',
        'limit_kredit' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function finances(): BelongsTo
    {
        return $this->belongsTo(Finansial::class, 'account_id');
    }
}