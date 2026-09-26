<?php

namespace App\Enums\Enums;

enum Prioritas: string
{
    case urgensi = 'Urgensi';
    case normal = 'Normal';
    case santai = 'Santai';

    public static function prioritas(): array
    {
        return array_map(fn($prioritas) => $prioritas->value, self::cases());
    }
}
