<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use SoftDeletes;

    protected $table = 'table_goal';

    protected $fillable = [
        'nama',
        'target_amount',
        'current_amount',
        'tanggal_target',
        'status',
        'catatan',
    ];

    protected $casts = [
        'status' => 'App\Enums\goalStatus_finansial',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'tanggal_target' => 'date',
    ];

    public static function add(array $data)
    {
        return self::create($data);
    }
}