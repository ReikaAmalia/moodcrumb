@extends('admin.layouts.app')

@section('title', 'Mood Management')

@section('page-title', 'Mood Management')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

        <div>
            <h2 class="text-lg font-bold text-[#2d1b14]">Daftar Mood</h2>
            <p class="mt-1 text-sm text-[#7d6559]">Kelola kategori mood yang tersedia untuk produk MoodCrumb.</p>
        </div>

        <a href="{{ route('admin.moods.create') }}" class="inline-flex items-center rounded-full bg-[#c46b3c] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#a9542d]">
            Tambah Mood
        </a>

    </div>


    <div class="overflow-hidden rounded-3xl border border-[#eadfd6] bg-white">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-[#eadfd6]">

                {{--
                    Header tabel: background krem (#f6e6da), sama persis
                    dengan tabel Produk. Tiap kolom dipisahkan garis
                    vertikal (divide-x) supaya lebih rapi.
                --}}
                <thead class="bg-[#f6e6da]">
                    <tr class="divide-x divide-[#eadfd6]">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Ikon</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Slug</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Deskripsi</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-[#9b4d2c]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eadfd6] bg-white">

                    @forelse ($moods as $mood)

                        <tr class="divide-x divide-[#eadfd6] transition hover:bg-[#fffaf6]">

                            {{-- Ikon --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#f1d2bc] text-xl">
                                    {{ $mood->icon ?? '😊' }}
                                </div>
                            </td>

                            {{-- Nama --}}
                            <td class="px-6 py-4">
                                <span class="font-semibold text-[#2d1b14]">{{ $mood->name }}</span>
                            </td>

                            {{-- Slug --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-[#7d6559]">
                                {{ $mood->slug }}
                            </td>

                            {{-- Deskripsi --}}
                            <td class="px-6 py-4 text-sm text-[#6b5145]">
                                {{ $mood->description ?? '-' }}
                            </td>

                            {{-- Aksi --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">

                                <a href="{{ route('admin.moods.edit', $mood) }}" class="mr-4 font-semibold text-[#c46b3c] hover:text-[#a9542d]">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.moods.destroy', $mood) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus mood ini?')">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 pt-16 pb-20 text-center">

                                <div class="text-5xl">😊</div>

                                <p class="mt-4 font-semibold text-[#2d1b14]">Belum ada mood.</p>

                                <p class="mt-1 text-sm text-[#7d6559]">Mulai tambahkan kategori mood pertama Anda.</p>

                                <div class="mt-6">
                                    <a href="{{ route('admin.moods.create') }}" class="inline-block rounded-full bg-[#c46b3c] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#a9542d]">
                                        Tambah Mood
                                    </a>
                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection