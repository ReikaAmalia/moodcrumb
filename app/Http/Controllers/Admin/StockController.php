<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateStockRequest;
use App\Models\Product;
use App\Services\Admin\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockController extends Controller
{
    public function __construct(
        protected StockService $stockService
    ) {
    }

    /**
     * Halaman utama Stock — tabel semua produk + form tambah/kurang.
     */
    public function index(): View
    {
        $products = $this->stockService->getAllProducts();

        return view('admin.stock.index', compact('products'));
    }

    /**
     * Halaman riwayat semua perubahan stok.
     */
    public function history(): View
    {
        $logs = $this->stockService->getHistory(15);

        return view('admin.stock.history', compact('logs'));
    }

    /**
     * Proses tambah stok.
     * Product di-inject otomatis lewat Route Model Binding
     * dari parameter {product} di URL.
     */
    public function addStock(
        UpdateStockRequest $request,
        Product $product
    ): RedirectResponse {
        $this->stockService->addStock(
            $product,
            $request->validated('quantity'),
            $request->validated('notes')
        );

        return redirect()
            ->route('admin.stock.index')
            ->with('success', "Stok {$product->name} berhasil ditambahkan.");
    }

    /**
     * Proses kurangi stok.
     * Kalau StockService melempar error "stok tidak cukup",
     * kita tangkap di sini dan ubah jadi pesan yang ramah,
     * bukan error mentah Laravel.
     */
    public function deductStock(
        UpdateStockRequest $request,
        Product $product
    ): RedirectResponse {
        try {
            $this->stockService->deductStock(
                $product,
                $request->validated('quantity'),
                $request->validated('notes')
            );
        } catch (\InvalidArgumentException $e) {
            return redirect()
                ->route('admin.stock.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('admin.stock.index')
            ->with('success', "Stok {$product->name} berhasil dikurangi.");
    }
}