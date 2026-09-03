<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin')
        - MoodCrumb
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 min-h-screen bg-white border-r border-gray-200">

            <div class="px-6 py-6 border-b border-gray-200">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-2xl font-bold text-gray-900"
                >
                    MoodCrumb
                </a>

                <p class="text-sm text-gray-500 mt-1">
                    Admin Panel
                </p>
            </div>

            <nav class="px-4 py-6 space-y-2">

                {{-- Dashboard --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 rounded-lg
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-700 hover:bg-gray-100'
                    }}"
                >
                    Dashboard
                </a>

                {{-- Mood --}}
                <a
                    href="{{ route('admin.moods.index') }}"
                    class="block px-4 py-3 rounded-lg
                    {{ request()->routeIs('admin.moods.*')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-700 hover:bg-gray-100'
                    }}"
                >
                    Mood Management
                </a>

            </nav>

        </aside>


        {{-- Main Content --}}
        <main class="flex-1">

            {{-- Header --}}
            <header
                class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between"
            >
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">
                        @yield('page-title', 'Dashboard')
                    </h1>
                </div>


                {{-- User --}}
                <div class="flex items-center gap-4">

                    <div class="text-right">

                        <p class="font-medium text-gray-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Admin
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium
                            text-red-600 border border-red-200
                            rounded-lg hover:bg-red-50"
                        >
                            Logout
                        </button>

                    </form>

                </div>

            </header>


            {{-- Content --}}
            <div class="p-8">

                {{-- Success Message --}}
                @if (session('success'))

                    <div
                        class="mb-6 rounded-lg
                        border border-green-200
                        bg-green-50
                        px-4 py-3
                        text-green-700"
                    >
                        {{ session('success') }}
                    </div>

                @endif


                {{-- Error Message --}}
                @if ($errors->any())

                    <div
                        class="mb-6 rounded-lg
                        border border-red-200
                        bg-red-50
                        px-4 py-3
                        text-red-700"
                    >

                        <ul class="list-disc list-inside">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

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