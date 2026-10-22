<?php

namespace App\Enums\Enums;

enum Status: string
{
    case Done = 'Done';
    case Pending = 'Pending';
    case Batal = 'Batal';
    case BelumDijalankan = 'Belum Dijalankan';

    public static function status(): array
    {
        return array_map(fn($status) => $status->value, self::cases());
    }
}
