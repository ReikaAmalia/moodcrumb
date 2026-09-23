<?php

namespace App\Models;

use App\Enums\StockAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * StockLog Model
 *
 * Merepresentasikan satu baris riwayat perubahan stok.
 * Sifatnya catatan sejarah — sekali dibuat, tidak pernah diedit.
 */
class StockLog extends Model
{
    /**
     * Kolom yang boleh diisi lewat StockLog::create([...]).
     */
    protected $fillable = [
        'product_id',
        'previous_stock',
        'new_stock',
        'action_type',
        'notes',
    ];

    /**
     * Tabel ini TIDAK punya kolom updated_at.
     * Baris const ini memberi tahu Eloquent: "jangan cari/isi
     * kolom updated_at, cukup urus created_at saja."
     */
    const UPDATED_AT = null;

    /**
     * Auto-convert tipe data.
     * - action_type: teks 'in'/'out' di DB → otomatis jadi
     *   object StockAction::In / StockAction::Out di PHP.
     */
    protected $casts = [
        'previous_stock' => 'integer',
        'new_stock'      => 'integer',
        'action_type'    => StockAction::class,
    ];

    /**
     * Satu log dimiliki oleh satu produk.
     * Bisa jadi NULL kalau produknya sudah dihapus (lihat migration).
     * Dipakai: $log->product?->name
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}