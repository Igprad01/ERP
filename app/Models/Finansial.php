<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Finansial extends Model
{
    use SoftDeletes;

    protected $table = 'finansials';

    protected $fillable = [
        'reference_number',
        'trip_id',
        'transaksi_date',
        'transaksi_type',
        'goal_id',
        'periode',
        'account_id',
        'account_to_id',
        'debt_id',
        'status',
        'type',
        'mekanisme_pembayaran',
        'total_cost',
        'catatan',
    ];

    protected $casts = [
        'transaksi_type' => 'App\Enums\Enums\TransaksiType',
        'periode' => 'App\Enums\SharedEnum',
        'status' => 'App\Enums\Enums\Status',
        'total_cost' => 'decimal:2',
        'transaksi_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $finansial) {
            $finansial->reference_number ??= static::generateReferenceNumber();
        });
    }

    public static function generateReferenceNumber(): string
    {
        do {
            $reference = 'TRX-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        } while (static::withTrashed()->where('reference_number', $reference)->exists());

        return $reference;
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function accountTo(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_to_id');
    }

    public function debt(): BelongsTo
    {
        return $this->belongsTo(Debt::class);
    }

    public static function view(array $filter = [])
    {
        $query = self::with(['category', 'account', 'accountTo', 'goal', 'debt', 'trip'])
            ->latest('transaksi_date')
            ->latest();

        if (! empty($filter['transaksi_type'])) {
            $query->where('transaksi_type', $filter['transaksi_type']);
        }

        if (! empty($filter['bulan'])) {
            $query->whereMonth('transaksi_date', $filter['bulan'])
                ->whereYear('transaksi_date', ! empty($filter['tahun']) ? $filter['tahun'] : now()->year);
        } elseif (! empty($filter['tahun'])) {
            $query->whereYear('transaksi_date', $filter['tahun']);
        }

        return $query->paginate(10)->withQueryString();
    }

    public static function add(array $array)
    {
        return DB::transaction(function () use ($array) {
            $finansial = self::create($array);
            $finansial->applySaldo(1);

            return $finansial;
        });
    }

    public static function edit(array $array, string $id)
    {
        return DB::transaction(function () use ($array, $id) {
            $finansial = self::findOrFail($id);
            $finansial->applySaldo(-1);
            $finansial->update($array);
            $finansial->applySaldo(1);

            return $finansial;
        });
    }

    public static function remove(string $id)
    {
        DB::transaction(function () use ($id) {
            $finansial = self::findOrFail($id);
            $finansial->applySaldo(-1);
            $finansial->delete();
        });
    }

    public static function formData(): array
    {
        return [
            'categories' => Category::all(),
            'accounts' => Account::where('is_active', true)->get(),
            'goals' => Goal::where('status', 'active')->get(),
            'debts' => Debt::where('status', 'active')->get(),
            'trips' => Trip::all(),
        ];
    }

    private function applySaldo(int $sign): void
    {
        if (! $this->account_id) {
            return;
        }

        $amount = $this->total_cost * $sign;

        switch ($this->transaksi_type?->value) {
            case 'income':
                Account::find($this->account_id)?->increment('saldo', $amount);
                break;
            case 'expense':
                Account::find($this->account_id)?->decrement('saldo', $amount);
                break;
            case 'transfer':
                Account::find($this->account_id)?->decrement('saldo', $amount);
                Account::find($this->account_to_id)?->increment('saldo', $amount);
                break;
        }
    }
}
