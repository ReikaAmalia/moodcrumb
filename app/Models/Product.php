<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Product Model
 *
 * Merepresentasikan produk cookies.
 * Kolom sesuai migration asli: mood_id, name, slug, description,
 * price, stock, image, is_active.
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'mood_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    /**
     * Auto-convert tipe data saat diambil dari database.
     * - is_active: 1/0 di DB → true/false di PHP
     * - price: otomatis 2 angka di belakang koma
     */
    protected $casts = [
        'price'     => 'decimal:2',
        'stock'     => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Satu produk dimiliki oleh satu mood.
     * Dipakai untuk: $product->mood->name
     */
    public function mood(): BelongsTo
    {
        return $this->belongsTo(Mood::class);
    }

    /**
     * Accessor untuk URL gambar lengkap.
     * Dipakai di Blade: {{ $product->image_url }}
     * Otomatis return null kalau produk belum punya gambar.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}