<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — MoodCrumb</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'mc-rose':   '#C8857A',
                'mc-rose-dk':'#A06858',
                'mc-cream':  '#FDF6F0',
                'mc-peach':  '#F8EDE8',
                'mc-border': '#EDD5C8',
                'mc-brown':  '#4A2C24',
                'mc-muted':  '#B08070',
            },
            fontFamily: {
                display: ['"Playfair Display"', 'serif'],
                body:    ['"Plus Jakarta Sans"', 'sans-serif'],
            }
        }
    }
}
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    body { font-family: "Plus Jakarta Sans", sans-serif; }
    .font-display { font-family: "Playfair Display", serif; }

    @keyframes blob {
        0%,100% { transform: translate(0,0) scale(1); }
        33%      { transform: translate(-15px,20px) scale(1.04); }
        66%      { transform: translate(12px,-8px) scale(0.98); }
    }
    .blob { animation: blob 9s ease-in-out infinite; }
    .blob-delay-3 { animation-delay: 3s; }
    .blob-delay-5 { animation-delay: 5s; }

    .mc-input:focus {
        outline: none;
        border-color: #C8857A;
        box-shadow: 0 0 0 3px rgba(200,133,122,0.15);
    }

    @keyframes shake {
        0%,100% { transform: translateX(0); }
        20%,60% { transform: translateX(-6px); }
        40%,80% { transform: translateX(6px); }
    }
    .shake { animation: shake 0.4s ease-in-out; }
</style>
</head>

<body class="bg-mc-cream min-h-screen font-body" x-data="loginPage()">

{{-- Decorative background --}}
<div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="blob absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-[#F0D0C8] opacity-40 blur-3xl"></div>
    <div class="blob blob-delay-3 absolute -top-32 right-1/3 w-80 h-80 rounded-full bg-[#FDECEA] opacity-35 blur-3xl"></div>
    <div class="blob blob-delay-5 absolute top-1/3 -left-24 w-72 h-72 rounded-full bg-[#F5E8D8] opacity-45 blur-3xl"></div>

    <span class="absolute bottom-20 right-20 text-3xl opacity-15 -rotate-12 select-none">🍪</span>
    <span class="absolute top-16 left-16 text-2xl opacity-10 rotate-6 select-none">✨</span>
    <span class="absolute top-1/2 right-10 text-xl opacity-10 rotate-12 select-none">🌸</span>
</div>

<div class="relative min-h-screen flex">

    {{-- ── Right branding panel (flipped from register) ── --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 order-last flex-col justify-between p-12
                bg-gradient-to-bl from-[#C8857A] via-[#B07268] to-[#7C4A3A] relative overflow-hidden">

        <div class="absolute inset-0 opacity-10">
            <div class="absolute bottom-16 right-16 w-48 h-48 rounded-full border-2 border-white"></div>
            <div class="absolute bottom-40 right-40 w-24 h-24 rounded-full border border-white"></div>
            <div class="absolute top-24 left-12 w-36 h-36 rounded-full border-2 border-white"></div>
            <div class="absolute top-48 left-36 w-16 h-16 rounded-full border border-white"></div>
        </div>

        <a href="/" class="flex items-center gap-3 relative z-10">
            <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                <span class="text-xl">🍪</span>
            </div>
            <span class="text-white text-xl font-bold font-display">MoodCrumb</span>
        </a>

        <div class="relative z-10 flex-1 flex flex-col justify-center py-16">
            <p class="text-white/60 text-sm font-medium uppercase tracking-widest mb-4">Selamat kembali</p>
            <h2 class="text-white font-display text-4xl xl:text-5xl font-bold leading-tight mb-6">
                Bagaimana<br>
                <span class="text-[#F5D5C8]">perasaanmu</span><br>
                hari ini? 🌿
            </h2>
            <p class="text-white/70 text-base leading-relaxed max-w-sm">
                Kami siap menemanimu — apapun yang kamu rasakan, ada cookies yang tepat untukmu.
            </p>

            {{-- Mood picker (decorative) --}}
            <div class="mt-8 grid grid-cols-2 gap-2 max-w-xs">
                <template x-for="mood in moods" :key="mood.label">
                    <div class="flex items-center gap-2 px-3 py-2 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm">
                        <span x-text="mood.emoji" class="text-base"></span>
                        <span x-text="mood.label" class="text-white/85 text-xs font-medium"></span>
                    </div>
                </template>
            </div>
        </div>

        {{-- Stats --}}
        <div class="relative z-10 grid grid-cols-3 gap-3">
            <template x-for="stat in stats" :key="stat.label">
                <div class="text-center bg-white/10 backdrop-blur rounded-2xl p-3 border border-white/15">
                    <p class="text-white text-lg font-bold font-display" x-text="stat.value"></p>
                    <p class="text-white/60 text-xs mt-0.5" x-text="stat.label"></p>
                </div>
            </template>
        </div>
    </div>

    {{-- ── Left form panel ── --}}
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 lg:px-12 xl:px-16">

        {{-- Mobile logo --}}
        <a href="/" class="lg:hidden flex items-center gap-2 mb-8">
            <div class="w-8 h-8 rounded-lg bg-mc-rose flex items-center justify-center">
                <span class="text-base">🍪</span>
            </div>
            <span class="text-mc-brown font-bold font-display text-lg">MoodCrumb</span>
        </a>

        <div class="w-full max-w-md">

            {{-- Heading --}}
            <div class="mb-8">
                <h1 class="text-2xl lg:text-3xl font-bold font-display text-mc-brown leading-tight">
                    Selamat datang kembali! 👋
                </h1>
                <p class="text-mc-muted text-sm mt-1.5">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-mc-rose font-semibold hover:text-mc-rose-dk transition-colors">Daftar gratis</a>
                </p>
            </div>

            {{-- Success message (after register redirect) --}}
            @if (session('success'))
            <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3">
                <span class="flex-shrink-0 text-emerald-500 mt-0.5">✅</span>
                <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
            </div>
            @endif

            {{-- Error message --}}
            @if ($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3"
                 :class="{ 'shake': hasError }" x-init="hasError = true">
                <span class="text-red-500 flex-shrink-0 mt-0.5">⚠️</span>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="text-red-700 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Google button --}}
            <a href="{{ route('auth.google.redirect') }}"
               class="flex items-center justify-center gap-3 w-full py-3 px-4 rounded-xl
                      bg-white border border-mc-border hover:border-mc-rose hover:shadow-sm
                      text-mc-brown text-sm font-semibold transition-all duration-200 mb-5 group">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Masuk dengan Google
            </a>

            {{-- Divider --}}
            <div class="flex items-center gap-3 mb-5">
                <div class="flex-1 h-px bg-mc-border"></div>
                <span class="text-xs text-mc-muted font-medium">atau masuk dengan email</span>
                <div class="flex-1 h-px bg-mc-border"></div>
            </div>

            {{-- Login form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-mc-brown mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-mc-muted">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="email@kamu.com"
                            autocomplete="email"
                            autofocus
                            class="mc-input w-full pl-10 pr-4 py-2.5 rounded-xl border border-mc-border bg-white
                                   text-sm text-mc-brown placeholder-mc-muted/60 transition-all
                                   @error('email') border-red-400 bg-red-50 @enderror"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-sm font-semibold text-mc-brown">Password</label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-xs text-mc-rose hover:text-mc-rose-dk font-medium transition-colors">
                            Lupa password?
                        </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-mc-muted">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <rect x="3" y="11" width="18" height="11" rx="2"/><path stroke-linecap="round" d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                        </span>
                        <input
                            :type="showPass ? 'text' : 'password'"
                            name="password"
                            placeholder="Password kamu"
                            autocomplete="current-password"
                            class="mc-input w-full pl-10 pr-11 py-2.5 rounded-xl border border-mc-border bg-white
                                   text-sm text-mc-brown placeholder-mc-muted/60 transition-all
                                   @error('password') border-red-400 bg-red-50 @enderror"
                        >
                        <button type="button" @click="showPass = !showPass"
                                class="absolute inset-y-0 right-3.5 flex items-center text-mc-muted hover:text-mc-rose transition-colors">
                            <svg x-show="!showPass" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPass" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="display:none;">
                                <path stroke-linecap="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember me --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-4 h-4 rounded border-mc-border text-mc-rose focus:ring-mc-rose/30 cursor-pointer">
                    <label for="remember" class="text-sm text-mc-muted cursor-pointer select-none">
                        Ingat saya selama 30 hari
                    </label>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-3 px-6 rounded-xl font-semibold text-sm transition-all duration-200 mt-2
                           bg-mc-rose text-white hover:bg-mc-rose-dk active:scale-[0.98]
                           shadow-sm hover:shadow-md"
                >
                    Masuk Sekarang
                </button>
            </form>

            {{-- Back to home --}}
            <div class="mt-6 text-center">
                <a href="/" class="inline-flex items-center gap-1.5 text-xs text-mc-muted hover:text-mc-rose transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function loginPage() {
    return {
        showPass:  false,
        hasError:  false,
        moods: [
            { emoji: '😢', label: 'Sedih' },
            { emoji: '😤', label: 'Marah' },
            { emoji: '😊', label: 'Bahagia' },
            { emoji: '🌙', label: 'Me Time' },
            { emoji: '🌀', label: 'Overthinking' },
            { emoji: '🌸', label: 'Self Care' },
        ],
        stats: [
            { value: '1.2K+', label: 'Pelanggan' },
            { value: '5',     label: 'Varian' },
            { value: '4.9⭐', label: 'Rating' },
        ],
    }
}
</script>
</body>
</html>