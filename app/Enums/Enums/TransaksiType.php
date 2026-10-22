<?php

namespace App\Enums\Enums;

enum TransaksiType: string

{
    case INCOME = 'income';
    case EXPENSE = 'expense';
    case TRANSFER = 'transfer';

    public function label(): string
    {
        return match ($this) {
            self::INCOME => 'Pemasukan',
            self::EXPENSE => 'Pengeluaran',
            self::TRANSFER => 'Transfer',
        };
    }
}
