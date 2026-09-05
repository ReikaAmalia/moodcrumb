<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar — MoodCrumb</title>
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

    /* Animated blobs */
    @keyframes blob {
        0%,100% { transform: translate(0,0) scale(1); }
        33%      { transform: translate(20px,-15px) scale(1.05); }
        66%      { transform: translate(-10px,10px) scale(0.97); }
    }
    .blob { animation: blob 8s ease-in-out infinite; }
    .blob-delay-2 { animation-delay: 2s; }
    .blob-delay-4 { animation-delay: 4s; }

    /* Input focus ring */
    .mc-input:focus {
        outline: none;
        border-color: #C8857A;
        box-shadow: 0 0 0 3px rgba(200,133,122,0.15);
    }

    /* Password strength bar */
    .strength-bar { transition: width 0.3s ease, background-color 0.3s ease; }
</style>
</head>

<body class="bg-mc-cream min-h-screen font-body" x-data="registerPage()">

{{-- ══════════════════════════════
     DECORATIVE BACKGROUND BLOBS
══════════════════════════════ --}}
<div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="blob blob-delay-0 absolute -top-24 -left-24 w-80 h-80 rounded-full bg-[#F0D0C8] opacity-50 blur-3xl"></div>
    <div class="blob blob-delay-2 absolute top-1/2 -right-32 w-96 h-96 rounded-full bg-[#FDECEA] opacity-40 blur-3xl"></div>
    <div class="blob blob-delay-4 absolute -bottom-20 left-1/3 w-72 h-72 rounded-full bg-[#F5E8D8] opacity-50 blur-3xl"></div>

    {{-- Scattered cookie emojis (decorative) --}}
    <span class="absolute top-16 right-16 text-3xl opacity-20 rotate-12 select-none">🍪</span>
    <span class="absolute bottom-32 left-12 text-2xl opacity-15 -rotate-6 select-none">🍪</span>
    <span class="absolute top-1/2 left-8 text-xl opacity-10 rotate-45 select-none">✨</span>
    <span class="absolute top-24 left-1/2 text-2xl opacity-10 -rotate-12 select-none">🌸</span>
</div>

{{-- ══════════════════════════════
     MAIN LAYOUT
══════════════════════════════ --}}
<div class="relative min-h-screen flex">

    {{-- ── Left panel (branding) — hidden on mobile ── --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col justify-between p-12 bg-gradient-to-br from-[#C8857A] to-[#7C4A3A] relative overflow-hidden">

        {{-- Background texture --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 rounded-full border-2 border-white"></div>
            <div class="absolute top-32 left-32 w-20 h-20 rounded-full border border-white"></div>
            <div class="absolute bottom-20 right-16 w-32 h-32 rounded-full border-2 border-white"></div>
            <div class="absolute bottom-40 right-40 w-16 h-16 rounded-full border border-white"></div>
        </div>

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3 relative z-10">
            <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                <span class="text-xl">🍪</span>
            </div>
            <span class="text-white text-xl font-bold font-display">MoodCrumb</span>
        </a>

        {{-- Center content --}}
        <div class="relative z-10 flex-1 flex flex-col justify-center py-16">
            <p class="text-white/60 text-sm font-medium uppercase tracking-widest mb-4">Bergabung dengan kami</p>
            <h2 class="text-white font-display text-4xl xl:text-5xl font-bold leading-tight mb-6">
                Temukan cookies<br>
                <span class="text-[#F5D5C8]">sesuai suasana</span><br>
                hatimu. 🌸
            </h2>
            <p class="text-white/70 text-base leading-relaxed max-w-sm">
                Lebih dari sekadar cookies — kami hadir menemani setiap momen emosionalmu dengan rasa yang tepat.
            </p>

            {{-- Mood chips --}}
            <div class="flex flex-wrap gap-2 mt-8">
                <template x-for="mood in moods" :key="mood">
                    <span class="px-3 py-1.5 rounded-full bg-white/15 text-white/90 text-xs font-medium border border-white/20 backdrop-blur-sm"
                          x-text="mood"></span>
                </template>
            </div>
        </div>

        {{-- Bottom quote --}}
        <div class="relative z-10 flex items-start gap-3 bg-white/10 backdrop-blur rounded-2xl p-4 border border-white/15">
            <span class="text-2xl flex-shrink-0">💬</span>
            <div>
                <p class="text-white text-sm leading-relaxed italic">
                    "Choco Calm beneran bikin aku lebih tenang pas lagi stres deadline."
                </p>
                <p class="text-white/60 text-xs mt-1.5">— Amanda P., pelanggan setia MoodCrumb</p>
            </div>
        </div>
    </div>

    {{-- ── Right panel (form) ── --}}
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
                    Buat akun baru ✨
                </h1>
                <p class="text-mc-muted text-sm mt-1.5">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-mc-rose font-semibold hover:text-mc-rose-dk transition-colors">Masuk di sini</a>
                </p>
            </div>

            {{-- Session errors --}}
            @if ($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                <span class="text-red-500 flex-shrink-0 mt-0.5">⚠️</span>
                <ul class="text-red-700 text-sm space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Google OAuth button --}}
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
                Daftar dengan Google
            </a>

            {{-- Divider --}}
            <div class="flex items-center gap-3 mb-5">
                <div class="flex-1 h-px bg-mc-border"></div>
                <span class="text-xs text-mc-muted font-medium">atau daftar dengan email</span>
                <div class="flex-1 h-px bg-mc-border"></div>
            </div>

            {{-- Register form --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-sm font-semibold text-mc-brown mb-1.5">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-mc-muted">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/>
                            </svg>
                        </span>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Nama lengkap kamu"
                            autocomplete="name"
                            class="mc-input w-full pl-10 pr-4 py-2.5 rounded-xl border border-mc-border bg-white
                                   text-sm text-mc-brown placeholder-mc-muted/60 transition-all
                                   @error('name') border-red-400 bg-red-50 @enderror"
                        >
                    </div>
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-mc-brown mb-1.5">
                        Email
                    </label>
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
                            class="mc-input w-full pl-10 pr-4 py-2.5 rounded-xl border border-mc-border bg-white
                                   text-sm text-mc-brown placeholder-mc-muted/60 transition-all
                                   @error('email') border-red-400 bg-red-50 @enderror"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label class="block text-sm font-semibold text-mc-brown mb-1.5">
                        Nomor WhatsApp
                        <span class="text-mc-muted font-normal">(opsional)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                            <span class="text-xs font-semibold text-mc-muted">+62</span>
                        </span>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="81234567890"
                            autocomplete="tel"
                            class="mc-input w-full pl-12 pr-4 py-2.5 rounded-xl border border-mc-border bg-white
                                   text-sm text-mc-brown placeholder-mc-muted/60 transition-all
                                   @error('phone') border-red-400 bg-red-50 @enderror"
                        >
                    </div>
                    @error('phone')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-mc-brown mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-mc-muted">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <rect x="3" y="11" width="18" height="11" rx="2"/><path stroke-linecap="round" d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                        </span>
                        <input
                            :type="showPass ? 'text' : 'password'"
                            name="password"
                            x-model="password"
                            placeholder="Min. 8 karakter"
                            autocomplete="new-password"
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

                    {{-- Password strength indicator --}}
                    <div class="mt-2" x-show="password.length > 0">
                        <div class="flex gap-1 mb-1">
                            <template x-for="i in 4" :key="i">
                                <div class="h-1 flex-1 rounded-full transition-all duration-300"
                                     :class="i <= passwordStrength ? strengthColor : 'bg-gray-200'"></div>
                            </template>
                        </div>
                        <p class="text-xs" :class="strengthTextColor" x-text="strengthLabel"></p>
                    </div>

                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-semibold text-mc-brown mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-mc-muted">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        <input
                            :type="showConfirm ? 'text' : 'password'"
                            name="password_confirmation"
                            x-model="passwordConfirm"
                            placeholder="Ulangi password kamu"
                            autocomplete="new-password"
                            class="mc-input w-full pl-10 pr-11 py-2.5 rounded-xl border bg-white
                                   text-sm text-mc-brown placeholder-mc-muted/60 transition-all"
                            :class="passwordConfirm.length > 0
                                ? (passwordMatch ? 'border-emerald-400' : 'border-red-400')
                                : 'border-mc-border'"
                        >
                        <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute inset-y-0 right-3.5 flex items-center text-mc-muted hover:text-mc-rose transition-colors">
                            <svg x-show="!showConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="display:none;">
                                <path stroke-linecap="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                        {{-- Match indicator --}}
                        <span x-show="passwordConfirm.length > 0 && passwordMatch"
                              class="absolute inset-y-0 right-10 flex items-center text-emerald-500" style="display:none;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                    <p x-show="passwordConfirm.length > 0 && !passwordMatch"
                       class="mt-1 text-xs text-red-600" style="display:none;">Password tidak cocok.</p>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    :disabled="!canSubmit"
                    class="w-full py-3 px-6 rounded-xl font-semibold text-sm transition-all duration-200 mt-2
                           bg-mc-rose text-white hover:bg-mc-rose-dk active:scale-[0.98]
                           disabled:opacity-50 disabled:cursor-not-allowed
                           shadow-sm hover:shadow-md"
                >
                    Buat Akun Sekarang 🍪
                </button>
            </form>

            {{-- Footer --}}
            <p class="text-center text-xs text-mc-muted mt-6 leading-relaxed">
                Dengan mendaftar, kamu menyetujui
                <a href="#" class="text-mc-rose hover:underline">Syarat & Ketentuan</a>
                dan
                <a href="#" class="text-mc-rose hover:underline">Kebijakan Privasi</a> kami.
            </p>
        </div>
    </div>
</div>

<script>
function registerPage() {
    return {
        password:        '',
        passwordConfirm: '',
        showPass:        false,
        showConfirm:     false,

        moods: ['😢 Sedih', '😤 Marah', '😔 Bad Mood', '🌀 Overthinking',
                '😊 Bahagia', '🌸 Self Care', '🌙 Me Time', '💪 Semangat'],

        get passwordStrength() {
            const p = this.password;
            if (p.length === 0) return 0;
            let score = 0;
            if (p.length >= 8)  score++;
            if (/[A-Z]/.test(p)) score++;
            if (/[0-9]/.test(p)) score++;
            if (/[^A-Za-z0-9]/.test(p)) score++;
            return score;
        },
        get strengthColor() {
            return ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-emerald-500'][this.passwordStrength - 1] || 'bg-red-400';
        },
        get strengthLabel() {
            return ['Terlalu lemah', 'Lemah', 'Cukup kuat', 'Kuat! 💪'][this.passwordStrength - 1] || '';
        },
        get strengthTextColor() {
            return ['text-red-600', 'text-orange-600', 'text-yellow-600', 'text-emerald-600'][this.passwordStrength - 1] || 'text-red-600';
        },
        get passwordMatch() {
            return this.password === this.passwordConfirm && this.passwordConfirm.length > 0;
        },
        get canSubmit() {
            return this.password.length >= 8 && this.passwordMatch;
        },
    }
}
</script>
</body>
</html>