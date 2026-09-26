<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'nama',
        'warna',
        'deskripsi',
    ];

    protected $table = 'table_category';
}
