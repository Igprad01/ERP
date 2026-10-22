<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use SoftDeletes;

    protected $table = 'table_debt';

    protected $fillable = [
        'nama',
        'type',
        'total_amount',
        'sisa_amount',
        'tanggal',
        'jatuh_tempo',
        'status',
        'akun_id',
        'catatan',
    ];

    protected $casts = [
        'type' => 'App\Enums\DebtType',
        'status' => 'App\Enums\goalStatus_finansial',
        'total_amount' => 'decimal:2',
        'sisa_amount' => 'decimal:2',
        'tanggal' => 'date',
        'jatuh_tempo' => 'date',
    ];

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}