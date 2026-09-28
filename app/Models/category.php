<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Override;
use App\Http\Requests\categoryRequest;

class category extends Model
{
    protected $fillable = [
        'nama',
        'warna',
        'deskripsi',
    ];

    protected $table = 'table_category';

    public function scopeView()
    {
        return self::oldest()->paginate(10);
    }

    public static function add(array $data)
    {
        return self::create($data);
    }

    public static function edit(array $data, string $id)
    {
        return self::where('id', $id)->update($data);
    }

    public static function remove(string $id)
    {
        return self::where('id', $id)->delete();
    }
}
