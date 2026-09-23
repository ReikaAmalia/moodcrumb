@extends('admin.layouts.app')

@section('title', 'Manajemen Stok')

@section('page-title', 'Manajemen Stok')

@section('content')

    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

        <div>
            <h2 class="text-lg font-bold text-[#2d1b14]">Manajemen Stok</h2>
            <p class="mt-1 text-sm text-[#7d6559]">Pantau dan perbarui stok produk MoodCrumb.</p>
        </div>

        <a href="{{ route('admin.stock.history') }}" class="inline-flex items-center rounded-full border border-[#d8c2b4] px-6 py-3 text-sm font-semibold text-[#2d1b14] transition hover:bg-[#f6e6da]">
            Riwayat Stok
        </a>

    </div>


    <div class="overflow-hidden rounded-3xl border border-[#eadfd6] bg-white">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-[#eadfd6]">

                <thead class="bg-[#f6e6da]">
                    <tr class="divide-x divide-[#eadfd6]">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Stok Saat Ini</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Tambah Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Kurangi Stok</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eadfd6] bg-white">

                    @forelse ($products as $product)

                        <tr class="divide-x divide-[#eadfd6]">

                            {{-- Nama Produk --}}
                            <td class="px-6 py-4">
                                <span class="font-semibold text-[#2d1b14]">{{ $product->name }}</span>
                            </td>

                            {{-- Stok Saat Ini --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="text-lg font-bold text-[#2d1b14]">{{ $product->stock }}</span>
                            </td>

                            {{-- Form Tambah --}}
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.stock.add', $product) }}" class="flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" min="1" placeholder="Jumlah" class="w-24 rounded-xl border-[#e4d3c6] bg-[#fffaf6] text-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>
                                    <button type="submit" class="rounded-full bg-[#c46b3c] px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#a9542d]">
                                        Tambah
                                    </button>
                                </form>
                            </td>

                            {{-- Form Kurangi --}}
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.stock.deduct', $product) }}" class="flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" min="1" placeholder="Jumlah" class="w-24 rounded-xl border-[#e4d3c6] bg-[#fffaf6] text-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>
                                    <button type="submit" class="rounded-full border border-red-300 px-4 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                                        Kurangi
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="px-6 pt-16 pb-20 text-center">

                                <div class="text-5xl">📦</div>

                                <p class="mt-4 font-semibold text-[#2d1b14]">Belum ada produk.</p>

                                <p class="mt-1 text-sm text-[#7d6559]">Tambahkan produk terlebih dahulu untuk mengelola stoknya.</p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection