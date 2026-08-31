<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case WaitingPayment = 'waiting_payment';
    case Paid = 'paid';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu Konfirmasi',
            self::WaitingPayment => 'Menunggu Pembayaran',
            self::Paid => 'Pembayaran Diterima',
            self::Processing => 'Sedang Diproses',
            self::Shipped => 'Pesanan Dikirim',
            self::Completed => 'Selesai',
            self::Cancelled => 'Dibatalkan',
        };
    }
}