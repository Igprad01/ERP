<?php

namespace App\Enums;

enum mekanisme_pembayaran: string
{
    case Transfer_bank = 'Transfer Bank';
    case Tunai = 'Tunai';
    case Qris = 'Qris';
    case Ewallet = 'Ewallet';

    public function label(): string
    {
        return match ($this) {
            self::Transfer_bank => 'Transfer Bank',
            self::Tunai => 'Tunai',
            self::Qris => 'Qris',
            self::Ewallet => 'Ewallet',
        };
    }
}
