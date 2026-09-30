<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class Trip extends Model
{
    protected $fillable = [
        'tanggal_mulai',
        'tanggal_akhir',
        'aktivitas',
        'lokasi',
        'category_id',
        'orang',
        'catatan',
        'status',
    ];

    protected $table = 'table_trip';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public static function add(array $array)
    {
        $tanggal_mulai = $array['tanggal_mulai'];
        $tanggal_akhir = $array['tanggal_akhir'];

        if ($tanggal_mulai > $tanggal_akhir) {
            return throw new \Exception('Tanggal mulai harus lebih kecil dari tanggal akhir');
        }
        return self::create($array);
    }

    public static function view()
    {
        return self::with('category')->oldest()->paginate(10);
    }
}
