<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;  
use Override;

class category extends Model
{
    protected $fillable = [
        'nama',
        'warna',
        'deskripsi',
    ];

    protected $table = 'table_category';

    public function scopeView($query)
    {
        return self::latest()->paginate(10);
    }
}
