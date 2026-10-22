<?php

namespace App\Enums;

enum AccountType_financial: string
{
    case Cash = 'cash';
    case Bank = 'bank';
    case Ewallet = 'ewallet';
    case CreditCard = 'credit_card';
    case Savings = 'savings';
    case Investment = 'investment';
    case Other = 'other';
    public function label(): string
    {
        return match ($this) {
            self::Cash => 'Tunai',
            self::Bank => 'Bank',
            self::Ewallet => 'E-Wallet',
            self::CreditCard => 'Kartu Kredit',
            self::Savings => 'Tabungan',
            self::Investment => 'Investasi',
            self::Other => 'Lainnya',
        };
    }
}
