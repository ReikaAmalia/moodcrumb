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

        {{-- Sidebar --}}
        <aside class="w-64 min-h-screen bg-white border-r border-[#eadfd6]">

            {{--
                Blok logo diberi tinggi tetap (h-20) supaya persis sejajar
                dengan tinggi header di sebelah kanan. Kalau tingginya beda,
                garis pembatas horizontal di bawahnya jadi tidak nyambung lurus.
            --}}
            <div class="h-20 flex flex-col justify-center px-6 border-b border-[#eadfd6]">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black tracking-tight">
                    Mood<span class="text-[#c46b3c]">Crumb</span>
                </a>
                <p class="text-xs text-[#9b8578] mt-0.5">Admin Panel</p>
            </div>

            <nav class="px-4 py-6 space-y-2">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-full font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#2d1b14] text-white' : 'text-[#6b5145] hover:bg-[#f6e6da]' }}">
                    Dashboard
                </a>

                {{-- Mood --}}
                <a href="{{ route('admin.moods.index') }}" class="block px-4 py-3 rounded-full font-medium transition {{ request()->routeIs('admin.moods.*') ? 'bg-[#2d1b14] text-white' : 'text-[#6b5145] hover:bg-[#f6e6da]' }}">
                    Mood Management
                </a>

                {{-- Produk --}}
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-3 rounded-full font-medium transition {{ request()->routeIs('admin.products.*') ? 'bg-[#2d1b14] text-white' : 'text-[#6b5145] hover:bg-[#f6e6da]' }}">
                    Produk
                </a>

            </nav>

        </aside>


        {{-- Main Content --}}
        <main class="flex-1">

            {{--
                Header juga diberi h-20, sama persis dengan blok logo sidebar,
                supaya garis batas bawah keduanya sejajar lurus.
            --}}
            <header class="h-20 flex items-center justify-between bg-white border-b border-[#eadfd6] px-8">

                <h1 class="text-xl font-bold text-[#2d1b14]">
                    @yield('page-title', 'Dashboard')
                </h1>

                {{-- User --}}
                <div class="flex items-center gap-4">

                    <div class="text-right">
                        <p class="font-semibold text-[#2d1b14]">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-[#9b8578]">Admin</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-red-600 border border-red-200 rounded-full hover:bg-red-50 transition">
                            Logout
                        </button>
                    </form>

                </div>

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