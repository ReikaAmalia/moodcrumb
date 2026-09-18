@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Total Pesanan --}}
        <div class="bg-white rounded-3xl border border-[#eadfd6] p-6">

            <p class="text-sm text-[#7d6559]">
                Total Pesanan
            </p>

            <h2 class="mt-3 text-3xl font-black text-[#2d1b14]">
                {{ $stats['total_orders'] ?? 0 }}
            </h2>

        </div>


        {{-- Pesanan Hari Ini --}}
        <div class="bg-white rounded-3xl border border-[#eadfd6] p-6">

            <p class="text-sm text-[#7d6559]">
                Pesanan Hari Ini
            </p>

            <h2 class="mt-3 text-3xl font-black text-[#2d1b14]">
                {{ $stats['today_orders'] ?? 0 }}
            </h2>

        </div>

    </div>


    <div class="mt-8 bg-white rounded-3xl border border-[#eadfd6] p-6">

        <h2 class="text-lg font-bold text-[#2d1b14]">
            Selamat Datang di Admin MoodCrumb
        </h2>

        <p class="mt-2 text-[#6b5145]">
            Kelola mood, produk, pesanan, dan data MoodCrumb lainnya
            dari panel admin ini.
        </p>

    </div>

@endsection