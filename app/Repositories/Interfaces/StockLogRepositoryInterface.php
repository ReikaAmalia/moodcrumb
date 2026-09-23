<?php

namespace App\Repositories\Interfaces;

use App\Models\StockLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * StockLogRepositoryInterface
 *
 * Kontrak akses data untuk tabel stock_logs.
 * Cuma 2 method — sesuai kebutuhan nyata sekarang (buat log baru,
 * lihat riwayat). Tidak dibuat method yang belum dipakai.
 */
interface StockLogRepositoryInterface
{
    /**
     * Simpan satu baris log baru.
     */
    public function create(array $data): StockLog;

    /**
     * Ambil semua riwayat log, terbaru duluan, dengan paginasi.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
}