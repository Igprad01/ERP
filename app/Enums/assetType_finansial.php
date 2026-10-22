<?php

namespace App\Enums;

enum assetType_finansial: string
{
    case Kas = 'kas';
    case Bank = 'bank';
    case Ewallet = 'ewallet';
    case CreditCard = 'credit_card';
    case Savings = 'savings';
    case Investment = 'investment';
    case Other = 'other';
    public function label(): string
    {
        return match ($this) {
            self::Kas => 'Tunai',
            self::Bank => 'Bank',
            self::Ewallet => 'E-Wallet',
            self::CreditCard => 'Kartu Kredit',
            self::Savings => 'Tabungan',
            self::Investment => 'Investasi',
            self::Other => 'Lainnya',
        };
    }
}

// besok dilanjutkan dan diselesaikan untuk finansial ini.