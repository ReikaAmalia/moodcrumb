<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Customer = 'customer';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Customer => 'Customer',
        };
    }

    /**
     * Tentukan URL tujuan redirect setelah login berhasil,
     * berdasarkan role user.
     */
    public function redirectAfterLogin(): string
    {
        return match ($this) {
            self::Admin    => route('admin.dashboard'),
            self::Customer => route('customer.dashboard'),
        };
    }
}