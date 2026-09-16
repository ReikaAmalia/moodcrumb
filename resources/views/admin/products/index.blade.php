@extends('admin.layouts.app')

@section('title', 'Daftar Produk')

@section('page-title', 'Daftar Produk')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

        <div>
            <h2 class="text-lg font-bold text-[#2d1b14]">Daftar Produk</h2>
            <p class="mt-1 text-sm text-[#7d6559]">Kelola produk cookies MoodCrumb berdasarkan mood.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center rounded-full bg-[#c46b3c] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#a9542d]">
            Tambah Produk
        </a>

    </div>


    <div class="overflow-hidden rounded-3xl border border-[#eadfd6] bg-white">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-[#eadfd6]">

                <thead class="bg-[#f6e6da]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Mood</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eadfd6] bg-white">

                    @forelse ($products as $product)

                        <tr class="transition hover:bg-[#fffaf6]">

                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-14 w-14 rounded-2xl object-cover">
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#f1d2bc] text-2xl">🍪</div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <span class="font-semibold text-[#2d1b14]">{{ $product->name }}</span>
                                <p class="mt-1 text-xs text-[#7d6559]">{{ $product->slug }}</p>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="rounded-full bg-[#f6e6da] px-3 py-1 text-xs font-semibold text-[#9b4d2c]">
                                    {{ $product->mood->icon }} {{ $product->mood->name }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 font-semibold text-[#2d1b14]">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-[#6b5145]">
                                {{ $product->stock }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($product->is_active)
                                    <span class="rounded-full bg-[#e6efd9] px-3 py-1 text-xs font-semibold text-[#657a45]">Aktif</span>
                                @else
                                    <span class="rounded-full bg-[#f3e7dd] px-3 py-1 text-xs font-semibold text-[#7d6559]">Tidak Aktif</span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.products.edit', $product) }}" class="mr-4 font-semibold text-[#c46b3c] hover:text-[#a9542d]">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>

                        </tr>

                    @empty

                        {{--
                            Empty state — padding atas/bawah dibuat lega (py-20)
                            dan tombol diberi jarak lebih (mb-2 pada wrapper)
                            supaya tidak menempel dengan garis bawah tabel.
                        --}}
                        <tr>
                            <td colspan="7" class="px-6 pt-16 pb-20 text-center">

                                <div class="text-5xl">🍪</div>

                                <p class="mt-4 font-semibold text-[#2d1b14]">Belum ada produk.</p>

                                <p class="mt-1 text-sm text-[#7d6559]">Mulai tambahkan produk cookies pertama Anda.</p>

                                <div class="mt-6">
                                    <a href="{{ route('admin.products.create') }}" class="inline-block rounded-full bg-[#c46b3c] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#a9542d]">
                                        Tambah Produk
                                    </a>
                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if ($products->hasPages())
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif

@endsection