<?php

namespace App\Enums;

enum DebtType: string
{
    case Hutang = 'hutang';
    case Piutang = 'piutang';

    public function label(): string
    {
        return match ($this) {
            self::Hutang => 'Hutang',
            self::Piutang => 'Piutang',
        };
    }
}