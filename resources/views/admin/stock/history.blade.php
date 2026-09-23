@extends('admin.layouts.app')

@section('title', 'Riwayat Stok')

@section('page-title', 'Riwayat Stok')

@php
    use App\Enums\StockAction;
@endphp

@section('content')

    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

        <div>
            <h2 class="text-lg font-bold text-[#2d1b14]">Riwayat Perubahan Stok</h2>
            <p class="mt-1 text-sm text-[#7d6559]">Semua catatan perubahan stok, diurutkan dari yang terbaru.</p>
        </div>

        <a href="{{ route('admin.stock.index') }}" class="inline-flex items-center rounded-full border border-[#d8c2b4] px-6 py-3 text-sm font-semibold text-[#2d1b14] transition hover:bg-[#f6e6da]">
            Kembali ke Stok
        </a>

    </div>


    <div class="overflow-hidden rounded-3xl border border-[#eadfd6] bg-white">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-[#eadfd6]">

                <thead class="bg-[#f6e6da]">
                    <tr class="divide-x divide-[#eadfd6]">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Stok Sebelum</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Stok Sesudah</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Jenis</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Tanggal</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eadfd6] bg-white">

                    @forelse ($logs as $log)

                        <tr class="divide-x divide-[#eadfd6]">

                            {{-- Nama Produk — fallback kalau sudah dihapus --}}
                            <td class="px-6 py-4">
                                @if ($log->product)
                                    <span class="font-semibold text-[#2d1b14]">{{ $log->product->name }}</span>
                                @else
                                    <span class="italic text-[#9b8578]">Produk sudah dihapus</span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-[#6b5145]">
                                {{ $log->previous_stock }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-[#6b5145]">
                                {{ $log->new_stock }}
                            </td>

                            {{-- Jenis: warna beda untuk Masuk vs Keluar --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($log->action_type === StockAction::In)
                                    <span class="rounded-full bg-[#e6efd9] px-3 py-1 text-xs font-semibold text-[#657a45]">
                                        {{ $log->action_type->label() }}
                                    </span>
                                @else
                                    <span class="rounded-full bg-[#fde5df] px-3 py-1 text-xs font-semibold text-[#b54b37]">
                                        {{ $log->action_type->label() }}
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-[#7d6559]">
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 pt-16 pb-20 text-center">

                                <div class="text-5xl">📋</div>

                                <p class="mt-4 font-semibold text-[#2d1b14]">Belum ada riwayat perubahan stok.</p>

                                <p class="mt-1 text-sm text-[#7d6559]">Riwayat akan muncul setelah ada perubahan stok.</p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($logs->hasPages())
            <div class="border-t border-[#eadfd6] px-6 py-4">
                {{ $logs->links() }}
            </div>
        @endif

    </div>

@endsection