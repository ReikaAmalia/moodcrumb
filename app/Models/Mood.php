<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Mood Model
 *
 * Merepresentasikan kategori mood (Sedih, Bahagia, Overthinking, dll).
 * Kolom sesuai migration asli: name, slug, description, icon.
 */
class Mood extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi lewat Mood::create([...]).
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    /**
     * Satu mood punya banyak produk.
     * Dipakai untuk: $mood->products
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}