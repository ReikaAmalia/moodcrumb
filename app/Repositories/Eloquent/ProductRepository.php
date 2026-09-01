<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::query()
            ->with('mood')
            ->latest()
            ->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Product::query()
            ->with('mood')
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id): ?Product
    {
        return Product::query()
            ->with('mood')
            ->find($id);
    }

    public function findBySlug(string $slug): ?Product
    {
        return Product::query()
            ->with('mood')
            ->where('slug', $slug)
            ->first();
    }

    public function getActive(): Collection
    {
        return Product::query()
            ->with('mood')
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    public function create(array $data): Product
    {
        return Product::query()->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);

        return $product->fresh();
    }

    public function delete(Product $product): bool
    {
        return (bool) $product->delete();
    }
}