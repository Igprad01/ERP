<?php

namespace App\Enums;

enum goalStatus_finansial: string
{
    case ACTIVE = 'active';
    case COMPLETE = 'complete';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Aktif',
            self::COMPLETE => 'Selesai',
            self::CANCELLED => 'Dibatalkan',
        };
    }
}
