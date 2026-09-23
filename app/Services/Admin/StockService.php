<?php

namespace App\Services\Admin;

use App\Enums\StockAction;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\StockLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected StockLogRepositoryInterface $stockLogRepository,
    ) {
    }

    /**
     * Ambil semua produk (untuk ditampilkan di halaman Stock Index).
     */
    public function getAllProducts(): Collection
    {
        return $this->productRepository->all();
    }

    /**
     * Ambil riwayat semua perubahan stok, dengan paginasi.
     */
    public function getHistory(int $perPage = 15): LengthAwarePaginator
    {
        return $this->stockLogRepository->paginate($perPage);
    }

    /**
     * Tambah stok produk.
     *
     * Langkah:
     * 1. Hitung angka stok baru
     * 2. Update products.stock
     * 3. Catat ke stock_logs
     * Langkah 2 & 3 dibungkus DB::transaction — kalau salah satu
     * gagal, dua-duanya dibatalkan otomatis.
     */
    public function addStock(Product $product, int $quantity, ?string $notes = null): Product
    {
        return DB::transaction(function () use ($product, $quantity, $notes) {

            $previousStock = $product->stock;
            $newStock      = $previousStock + $quantity;

            $updatedProduct = $this->productRepository->update(
                $product,
                ['stock' => $newStock]
            );

            $this->stockLogRepository->create([
                'product_id'     => $product->id,
                'previous_stock' => $previousStock,
                'new_stock'      => $newStock,
                'action_type'    => StockAction::In->value,
                'notes'          => $notes,
            ]);

            return $updatedProduct;
        });
    }

    /**
     * Kurangi stok produk.
     *
     * Pengecekan "stok cukup atau tidak" dilakukan SEBELUM masuk
     * transaction — kalau tidak cukup, langsung tolak dengan
     * exception, tidak ada perubahan apapun yang tersentuh.
     *
     * @throws \InvalidArgumentException jika stok tidak mencukupi
     */
    public function deductStock(Product $product, int $quantity, ?string $notes = null): Product
    {
        if ($product->stock < $quantity) {
            throw new \InvalidArgumentException(
                "Stok tidak mencukupi. Stok saat ini: {$product->stock}, diminta: {$quantity}."
            );
        }

        return DB::transaction(function () use ($product, $quantity, $notes) {

            $previousStock = $product->stock;
            $newStock      = $previousStock - $quantity;

            $updatedProduct = $this->productRepository->update(
                $product,
                ['stock' => $newStock]
            );

            $this->stockLogRepository->create([
                'product_id'     => $product->id,
                'previous_stock' => $previousStock,
                'new_stock'      => $newStock,
                'action_type'    => StockAction::Out->value,
                'notes'          => $notes,
            ]);

            return $updatedProduct;
        });
    }
}