<?php

namespace App\Enums\Enums;

enum Status: string
{
    case selesai = 'Selesai';
    case pending = 'Pending';
    case on_progress = 'On Progress';
    case belum_dikerjakan = 'Belum Dikerjakan';
    case Coming_Soon = 'Coming Soon';

    public static function status(): array
    {
        return array_map(fn($status) => $status->value, self::cases());
    }
}
