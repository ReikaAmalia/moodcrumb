<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Services\Admin\MoodService;
use App\Services\Admin\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected MoodService $moodService
    ) {
    }

    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = $this->productService->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $moods = $this->moodService->getAll();

        return view('admin.products.create', compact('moods'));
    }

    /**
     * Store a newly created product.
     */
    public function store(
        StoreProductRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        // Simpan file gambar ke storage/app/public/products
        // store() mengembalikan path relatif, contoh: "products/abc123.jpg"
        $data['image'] = $request
            ->file('image')
            ->store('products', 'public');

        $this->productService->create($data);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $moods = $this->moodService->getAll();

        return view(
            'admin.products.edit',
            compact('product', 'moods')
        );
    }

    /**
     * Update the specified product.
     */
    public function update(
        UpdateProductRequest $request,
        Product $product
    ): RedirectResponse {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Hapus gambar lama agar tidak menjadi file sampah
            if (
                $product->image
                && Storage::disk('public')->exists($product->image)
            ) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('products', 'public');
        } else {
            // Tidak ada gambar baru: jangan sentuh kolom image
            unset($data['image']);
        }

        $this->productService->update($product, $data);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified product.
     */
    public function destroy(
        Product $product
    ): RedirectResponse {
        $imagePath = $product->image;

        $this->productService->delete($product);

        // Hapus file gambar setelah record berhasil dihapus
        if (
            $imagePath
            && Storage::disk('public')->exists($imagePath)
        ) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );
    }
}