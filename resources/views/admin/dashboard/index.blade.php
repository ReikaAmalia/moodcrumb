@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Total Orders --}}
        <div
            class="bg-white rounded-xl border border-gray-200 p-6"
        >

            <p class="text-sm text-gray-500">
                Total Orders
            </p>

            <h2 class="mt-3 text-3xl font-bold text-gray-900">
                {{ $stats['total_orders'] ?? 0 }}
            </h2>

        </div>


        {{-- Today's Orders --}}
        <div
            class="bg-white rounded-xl border border-gray-200 p-6"
        >

            <p class="text-sm text-gray-500">
                Today's Orders
            </p>

            <h2 class="mt-3 text-3xl font-bold text-gray-900">
                {{ $stats['today_orders'] ?? 0 }}
            </h2>

        </div>

    </div>


    <div
        class="mt-8 bg-white rounded-xl border border-gray-200 p-6"
    >

        <h2 class="text-lg font-semibold text-gray-900">
            Welcome to MoodCrumb Admin
        </h2>

        <p class="mt-2 text-gray-600">
            Manage moods, products, orders, and other MoodCrumb data
            from this admin panel.
        </p>

    </div>

@endsection