<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class activities extends Model
{
    protected $fillable = [
        'trip_id',
        'waktu',
        'nama_aktivitas',
        'prioritas',
    ];

    protected $table = 'table_activities';

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public static function DetailView(string $trip_id)
    {

        return Trip::all()->findOrFail($trip_id);
    }
}
