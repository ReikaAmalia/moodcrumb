<?php

namespace App\Enums;

enum StockAction: string
{
    case In = 'in';
    case Out = 'out';

    /**
     * Label Bahasa Indonesia untuk ditampilkan di UI.
     * Ditambahkan supaya Blade tidak perlu menulis logic
     * terjemahan sendiri (if/else 'in' -> 'Stok Masuk').
     */
    public function label(): string
    {
        return match ($this) {
            self::In  => 'Stok Masuk',
            self::Out => 'Stok Keluar',
        };
    }
}