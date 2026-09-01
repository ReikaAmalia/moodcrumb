<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->productRepository->all();
    }

    public function paginate(
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->productRepository->paginate($perPage);
    }

    public function getById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    public function getBySlug(string $slug): ?Product
    {
        return $this->productRepository->findBySlug($slug);
    }

    public function getActive(): Collection
    {
        return $this->productRepository->getActive();
    }

    public function create(array $data): Product
    {
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        return $this->productRepository->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        if (isset($data['name']) && $data['name'] !== $product->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $product->id
            );
        }

        return $this->productRepository->update($product, $data);
    }

    public function delete(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }

    protected function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $existingProduct = $this->productRepository->findBySlug($slug);

            if (
                ! $existingProduct
                || (
                    $ignoreId !== null
                    && $existingProduct->id === $ignoreId
                )
            ) {
                return $slug;
            }

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }
    }
}