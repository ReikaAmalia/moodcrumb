<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin')
        - MoodCrumb
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffaf6] text-[#2d1b14]">

    <div class="min-h-screen flex">

        {{--
            Sidebar: coklat tua (#2d1b14).
            Tidak ada garis pemisah (border) sama sekali di dalamnya —
            pembagian antar blok (logo / menu / profil) cuma dari
            spacing (jarak), bukan garis.
        --}}
        <aside class="w-64 min-h-screen bg-[#2d1b14] flex flex-col">

            {{-- Logo — tanpa garis pemisah di bawahnya --}}
            <div class="flex items-center gap-3 px-6 h-20">

                <div class="w-9 h-9 rounded-xl bg-[#c46b3c] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 14l4-4 3 3 5-6"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="text-lg font-black tracking-tight text-white leading-tight">MoodCrumb</p>
                    <p class="text-xs text-[#c9ada0] leading-tight">Admin Panel</p>
                </div>

            </div>


            {{-- Menu --}}
            <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto">

                {{-- Grup: Utama --}}
                <div>

                    <p class="px-4 mb-2 text-xs font-semibold uppercase tracking-widest text-[#c9ada0]">
                        Utama
                    </p>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#a9542d] text-white' : 'text-[#d8c2b4] hover:bg-[#3b261d] hover:text-white' }}">

                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                            <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                            <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                            <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                        </svg>

                        Dashboard

                    </a>

                </div>


                {{-- Grup: Katalog --}}
                <div>

                    <p class="px-4 mb-2 text-xs font-semibold uppercase tracking-widest text-[#c9ada0]">
                        Katalog
                    </p>

                    <div class="space-y-1">

                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold transition {{ request()->routeIs('admin.products.*') ? 'bg-[#a9542d] text-white' : 'text-[#d8c2b4] hover:bg-[#3b261d] hover:text-white' }}">

                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                            </svg>

                            Produk

                        </a>

                        <a href="{{ route('admin.moods.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold transition {{ request()->routeIs('admin.moods.*') ? 'bg-[#a9542d] text-white' : 'text-[#d8c2b4] hover:bg-[#3b261d] hover:text-white' }}">

                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" d="M8.5 14s1.5 2 3.5 2 3.5-2 3.5-2"/>
                                <circle cx="9" cy="9.5" r="1" fill="currentColor" stroke="none"/>
                                <circle cx="15" cy="9.5" r="1" fill="currentColor" stroke="none"/>
                            </svg>

                            Mood Management

                        </a>

                    </div>

                </div>

            </nav>


            {{-- Profil + Logout — tanpa garis pemisah di atasnya --}}
            <div class="p-4">

                <div class="flex items-center gap-3 bg-[#3b261d] rounded-2xl p-3">

                    <div class="w-9 h-9 rounded-full bg-[#c46b3c] flex items-center justify-center flex-shrink-0 text-white font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-[#c9ada0] truncate">{{ auth()->user()->email }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Logout" class="w-8 h-8 rounded-lg flex items-center justify-center text-[#d8c2b4] hover:bg-[#4a2d22] hover:text-white transition flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 17l5-5-5-5"/>
                                <path stroke-linecap="round" d="M21 12H9"/>
                            </svg>
                        </button>
                    </form>

                </div>

            </div>

        </aside>


        {{-- Main Content --}}
        <main class="flex-1">

            {{--
                Header: warna PERSIS SAMA dengan sidebar (#2d1b14),
                dan tanpa garis pemisah di bawahnya.
            --}}
            <header class="h-20 flex items-center bg-[#2d1b14] px-8">
                <h1 class="text-xl font-bold text-white">
                    @yield('page-title', 'Dashboard')
                </h1>
            </header>


            {{-- Content --}}
            <div class="p-8">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-6 rounded-3xl border border-[#c8e0b0] bg-[#e6efd9] px-5 py-4 text-[#4d6335] font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Message --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </div>

        </main>

    </div>

</body>
</html>