<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>MoodCrumb — Cookies for Every Mood</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-[#fffaf6] text-[#2d1b14]">

    {{-- ============================= --}}
    {{-- NAVBAR --}}
    {{-- ============================= --}}

    <header
        class="sticky top-0 z-50 border-b border-[#eadfd6] bg-[#fffaf6]/95 backdrop-blur"
    >
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5"
        >

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="text-2xl font-black tracking-tight"
            >
                Mood<span class="text-[#c46b3c]">Crumb</span>
            </a>


            {{-- Navigation --}}
            <nav
                class="hidden items-center gap-8 text-sm font-medium md:flex"
            >
                <a
                    href="#home"
                    class="transition hover:text-[#c46b3c]"
                >
                    Home
                </a>

                <a
                    href="#moods"
                    class="transition hover:text-[#c46b3c]"
                >
                    Find Your Mood
                </a>

                <a
                    href="#products"
                    class="transition hover:text-[#c46b3c]"
                >
                    Cookies
                </a>

                <a
                    href="#about"
                    class="transition hover:text-[#c46b3c]"
                >
                    About Us
                </a>
            </nav>


            {{-- Authentication --}}
            <div
                class="flex items-center gap-3"
            >
                @auth

                    @if(auth()->user()->role === 'admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="rounded-full bg-[#2d1b14] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#4a2d22]"
                        >
                            Dashboard
                        </a>

                    @else

                        <a
                            href="{{ route('customer.dashboard') }}"
                            class="rounded-full bg-[#2d1b14] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#4a2d22]"
                        >
                            Dashboard
                        </a>

                    @endif

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden text-sm font-semibold transition hover:text-[#c46b3c] sm:block"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-full bg-[#c46b3c] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a9542d]"
                    >
                        Join MoodCrumb
                    </a>

                @endauth
            </div>

        </div>
    </header>



    {{-- ============================= --}}
    {{-- HERO --}}
    {{-- ============================= --}}

    <main>

        <section
            id="home"
            class="relative overflow-hidden"
        >

            <div
                class="mx-auto grid min-h-[720px] max-w-7xl items-center gap-16 px-6 py-20 lg:grid-cols-2"
            >

                {{-- Hero Content --}}
                <div>

                    <div
                        class="mb-6 inline-flex items-center gap-2 rounded-full bg-[#f6e6da] px-4 py-2 text-sm font-medium text-[#9b4d2c]"
                    >
                        🍪 Cookies made for your feelings
                    </div>


                    <h1
                        class="max-w-2xl text-5xl font-black leading-[1.05] tracking-tight md:text-6xl lg:text-7xl"
                    >
                        Every mood deserves
                        <span class="text-[#c46b3c]">
                            the perfect cookie.
                        </span>
                    </h1>


                    <p
                        class="mt-7 max-w-xl text-lg leading-8 text-[#6b5145]"
                    >
                       Coba cerita, hari ini kamu lagi ngerasa apa? 
                       Happy, capek, butuh semangat, atau lagi pengen dimanjain? 
                       Cari cookies yang paling nyambung sama mood kamu, yuk. 🍪
                    </p>


                    <div
                        class="mt-10 flex flex-wrap gap-4"
                    >

                        <a
                            href="#moods"
                            class="rounded-full bg-[#2d1b14] px-7 py-4 font-semibold text-white transition hover:-translate-y-1 hover:bg-[#4a2d22]"
                        >
                            Find My Mood 🍪
                        </a>


                        <a
                            href="#products"
                            class="rounded-full border border-[#d8c2b4] px-7 py-4 font-semibold transition hover:bg-[#f6e6da]"
                        >
                            Explore Cookies
                        </a>

                    </div>


                    {{-- Small Stats --}}
                    <div
                        class="mt-14 flex flex-wrap gap-10"
                    >

                        <div>

                            <p
                                class="text-2xl font-bold"
                            >
                                5+
                            </p>

                            <p
                                class="mt-1 text-sm text-[#7d6559]"
                            >
                                Mood Collections
                            </p>

                        </div>


                        <div>

                            <p
                                class="text-2xl font-bold"
                            >
                                Fresh
                            </p>

                            <p
                                class="mt-1 text-sm text-[#7d6559]"
                            >
                                Baked with love
                            </p>

                        </div>


                        <div>

                            <p
                                class="text-2xl font-bold"
                            >
                                100%
                            </p>

                            <p
                                class="mt-1 text-sm text-[#7d6559]"
                            >
                                Mood approved
                            </p>

                        </div>

                    </div>

                </div>



                {{-- Hero Illustration --}}
                <div
                    class="relative flex items-center justify-center"
                >

                    <div
                        class="absolute h-[430px] w-[430px] rounded-full bg-[#f3c6a7] blur-3xl opacity-60"
                    ></div>


                    <div
                        class="relative flex h-[480px] w-[480px] items-center justify-center rounded-[80px] bg-[#e8a87c] shadow-2xl"
                    >

                        {{-- Cookie --}}
                        <div
                            class="relative flex h-[320px] w-[320px] items-center justify-center rounded-full bg-[#c97945] shadow-2xl"
                        >

                            <div
                                class="absolute h-10 w-10 rounded-full bg-[#4a2818]"
                                style="top: 70px; left: 75px;"
                            ></div>

                            <div
                                class="absolute h-8 w-8 rounded-full bg-[#4a2818]"
                                style="top: 90px; right: 70px;"
                            ></div>

                            <div
                                class="absolute h-9 w-9 rounded-full bg-[#4a2818]"
                                style="bottom: 80px; left: 60px;"
                            ></div>

                            <div
                                class="absolute h-8 w-8 rounded-full bg-[#4a2818]"
                                style="bottom: 60px; right: 80px;"
                            ></div>

                            <div
                                class="absolute h-7 w-7 rounded-full bg-[#4a2818]"
                                style="top: 145px; left: 140px;"
                            ></div>

                        </div>

                    </div>


                    {{-- Floating Card --}}
                    <div
                        class="absolute -left-4 top-10 rounded-3xl bg-white p-5 shadow-xl"
                    >

                        <p
                            class="text-sm text-gray-500"
                        >
                            Your current mood
                        </p>

                        <p
                            class="mt-1 text-xl font-bold"
                        >
                            😊 Happy
                        </p>

                    </div>


                    <div
                        class="absolute -right-5 bottom-12 rounded-3xl bg-[#2d1b14] p-5 text-white shadow-xl"
                    >

                        <p
                            class="text-sm text-[#d8c2b4]"
                        >
                            Perfect match
                        </p>

                        <p
                            class="mt-1 font-bold"
                        >
                            Berry Bright 🍓
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- ============================= --}}
        {{-- MOOD SECTION --}}
        {{-- ============================= --}}

        <section
            id="moods"
            class="bg-[#2d1b14] py-24 text-white"
        >

            <div
                class="mx-auto max-w-7xl px-6"
            >

                <div
                    class="mx-auto max-w-2xl text-center"
                >

                    <p
                        class="text-sm font-semibold uppercase tracking-[0.25em] text-[#e8a87c]"
                    >
                        How are you feeling?
                    </p>


                    <h2
                        class="mt-5 text-4xl font-black md:text-5xl"
                    >
                        Pick your mood.
                        <br>
                        We'll pick your cookie.
                    </h2>


                    <p
                        class="mt-6 text-[#d8c2b4]"
                    >
                        Every mood has its own flavor.
                        Tell us how you feel and find the cookie
                        that matches your moment.
                    </p>

                </div>



                <div
                    class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-5"
                >

                    <div
                        class="group cursor-pointer rounded-3xl bg-[#3b261d] p-7 transition hover:-translate-y-2 hover:bg-[#4a2d22]"
                    >
                        <div class="text-4xl">😌</div>

                        <h3 class="mt-5 text-xl font-bold">
                            Calm
                        </h3>

                        <p class="mt-2 text-sm text-[#c9ada0]">
                            Slow down and relax.
                        </p>
                    </div>


                    <div
                        class="group cursor-pointer rounded-3xl bg-[#3b261d] p-7 transition hover:-translate-y-2 hover:bg-[#4a2d22]"
                    >
                        <div class="text-4xl">😊</div>

                        <h3 class="mt-5 text-xl font-bold">
                            Happy
                        </h3>

                        <p class="mt-2 text-sm text-[#c9ada0]">
                            Celebrate the moment.
                        </p>
                    </div>


                    <div
                        class="group cursor-pointer rounded-3xl bg-[#3b261d] p-7 transition hover:-translate-y-2 hover:bg-[#4a2d22]"
                    >
                        <div class="text-4xl">🥰</div>

                        <h3 class="mt-5 text-xl font-bold">
                            Loved
                        </h3>

                        <p class="mt-2 text-sm text-[#c9ada0]">
                            Something warm and sweet.
                        </p>
                    </div>


                    <div
                        class="group cursor-pointer rounded-3xl bg-[#3b261d] p-7 transition hover:-translate-y-2 hover:bg-[#4a2d22]"
                    >
                        <div class="text-4xl">😔</div>

                        <h3 class="mt-5 text-xl font-bold">
                            Moody
                        </h3>

                        <p class="mt-2 text-sm text-[#c9ada0]">
                            A little comfort helps.
                        </p>
                    </div>


                    <div
                        class="group cursor-pointer rounded-3xl bg-[#3b261d] p-7 transition hover:-translate-y-2 hover:bg-[#4a2d22]"
                    >
                        <div class="text-4xl">✨</div>

                        <h3 class="mt-5 text-xl font-bold">
                            Peaceful
                        </h3>

                        <p class="mt-2 text-sm text-[#c9ada0]">
                            Enjoy the quiet moment.
                        </p>
                    </div>

                </div>

            </div>

        </section>



        {{-- ============================= --}}
        {{-- PRODUCTS --}}
        {{-- ============================= --}}

        <section
            id="products"
            class="py-24"
        >

            <div
                class="mx-auto max-w-7xl px-6"
            >

                <div
                    class="flex flex-col justify-between gap-6 md:flex-row md:items-end"
                >

                    <div>

                        <p
                            class="text-sm font-semibold uppercase tracking-[0.25em] text-[#c46b3c]"
                        >
                            Mood Collections
                        </p>


                        <h2
                            class="mt-4 text-4xl font-black md:text-5xl"
                        >
                            Cookies for every feeling.
                        </h2>

                    </div>


                    <a
                        href="#"
                        class="font-semibold text-[#c46b3c]"
                    >
                        View all cookies →
                    </a>

                </div>



                <div
                    class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-3"
                >

                    {{-- Product 1 --}}
                    <article
                        class="overflow-hidden rounded-[32px] bg-white shadow-sm transition hover:-translate-y-2 hover:shadow-xl"
                    >

                        <div
                            class="flex h-64 items-center justify-center bg-[#f1d2bc] text-8xl"
                        >
                            🍫
                        </div>


                        <div class="p-7">

                            <div
                                class="flex items-center justify-between"
                            >
                                <span
                                    class="rounded-full bg-[#f6e6da] px-3 py-1 text-xs font-semibold text-[#9b4d2c]"
                                >
                                    Calm
                                </span>

                                <span class="text-sm text-gray-500">
                                    ⭐ 4.9
                                </span>
                            </div>


                            <h3
                                class="mt-5 text-2xl font-bold"
                            >
                                Choco Calm
                            </h3>


                            <p
                                class="mt-3 text-sm leading-6 text-gray-600"
                            >
                                Rich chocolate cookies for those quiet,
                                slow, comforting moments.
                            </p>


                            <div
                                class="mt-6 flex items-center justify-between"
                            >
                                <span
                                    class="text-lg font-bold"
                                >
                                    Rp25.000
                                </span>

                                <button
                                    class="rounded-full bg-[#2d1b14] px-5 py-2 text-sm font-semibold text-white"
                                >
                                    View
                                </button>
                            </div>

                        </div>

                    </article>



                    {{-- Product 2 --}}
                    <article
                        class="overflow-hidden rounded-[32px] bg-white shadow-sm transition hover:-translate-y-2 hover:shadow-xl"
                    >

                        <div
                            class="flex h-64 items-center justify-center bg-[#f7b7a7] text-8xl"
                        >
                            🍓
                        </div>


                        <div class="p-7">

                            <div
                                class="flex items-center justify-between"
                            >
                                <span
                                    class="rounded-full bg-[#fde5df] px-3 py-1 text-xs font-semibold text-[#b54b37]"
                                >
                                    Happy
                                </span>

                                <span class="text-sm text-gray-500">
                                    ⭐ 4.8
                                </span>
                            </div>


                            <h3
                                class="mt-5 text-2xl font-bold"
                            >
                                Berry Bright
                            </h3>


                            <p
                                class="mt-3 text-sm leading-6 text-gray-600"
                            >
                                Sweet berry flavors for bright,
                                happy and energetic days.
                            </p>


                            <div
                                class="mt-6 flex items-center justify-between"
                            >
                                <span
                                    class="text-lg font-bold"
                                >
                                    Rp28.000
                                </span>

                                <button
                                    class="rounded-full bg-[#2d1b14] px-5 py-2 text-sm font-semibold text-white"
                                >
                                    View
                                </button>
                            </div>

                        </div>

                    </article>



                    {{-- Product 3 --}}
                    <article
                        class="overflow-hidden rounded-[32px] bg-white shadow-sm transition hover:-translate-y-2 hover:shadow-xl"
                    >

                        <div
                            class="flex h-64 items-center justify-center bg-[#d8e3c5] text-8xl"
                        >
                            🍵
                        </div>


                        <div class="p-7">

                            <div
                                class="flex items-center justify-between"
                            >
                                <span
                                    class="rounded-full bg-[#e6efd9] px-3 py-1 text-xs font-semibold text-[#657a45]"
                                >
                                    Peaceful
                                </span>

                                <span class="text-sm text-gray-500">
                                    ⭐ 4.9
                                </span>
                            </div>


                            <h3
                                class="mt-5 text-2xl font-bold"
                            >
                                Matcha Peace
                            </h3>


                            <p
                                class="mt-3 text-sm leading-6 text-gray-600"
                            >
                                A smooth matcha cookie for peaceful
                                and mindful moments.
                            </p>


                            <div
                                class="mt-6 flex items-center justify-between"
                            >
                                <span
                                    class="text-lg font-bold"
                                >
                                    Rp30.000
                                </span>

                                <button
                                    class="rounded-full bg-[#2d1b14] px-5 py-2 text-sm font-semibold text-white"
                                >
                                    View
                                </button>
                            </div>

                        </div>

                    </article>

                </div>

            </div>

        </section>



        {{-- ============================= --}}
        {{-- ABOUT --}}
        {{-- ============================= --}}

        <section
            id="about"
            class="bg-[#f3e7dd] py-24"
        >

            <div
                class="mx-auto grid max-w-7xl gap-16 px-6 lg:grid-cols-2"
            >

                <div
                    class="flex items-center justify-center"
                >

                    <div
                        class="flex h-80 w-80 items-center justify-center rounded-full bg-[#c46b3c] text-9xl shadow-2xl"
                    >
                        🍪
                    </div>

                </div>


                <div
                    class="flex flex-col justify-center"
                >

                    <p
                        class="text-sm font-semibold uppercase tracking-[0.25em] text-[#c46b3c]"
                    >
                        About MoodCrumb
                    </p>


                    <h2
                        class="mt-5 text-4xl font-black md:text-5xl"
                    >
                        More than just cookies. It's a little piece of comfort.
                    </h2>


                    <p
                        class="mt-7 leading-8 text-[#6b5145]"
                    >
                        Kadang, yang kita butuhkan bukan jawaban.
                        Bukan juga sesuatu yang besar.

                        Mungkin cuma satu gigitan manis di tengah hari yang panjang.
                        Sesuatu yang hangat untuk menemani saat hati sedang ramai.
                        Atau sedikit rasa manis untuk merayakan hari yang terasa begitu baik.
                    </p>


                    <p
                        class="mt-5 leading-8 text-[#6b5145]"
                    >
                        Di MoodCrumb, setiap cookie dibuat bukan sekadar untuk dinikmati—
                        tetapi untuk menemani setiap versi perasaanmu.

                        Karena apa pun mood kamu hari ini, kamu selalu pantas punya sesuatu yang terasa nyaman. 🍪🤎
                    </p>


                    <a
                        href="#moods"
                        class="mt-8 w-fit rounded-full bg-[#2d1b14] px-7 py-4 font-semibold text-white transition hover:bg-[#4a2d22]"
                    >
                        Find Your Cookie
                    </a>

                </div>

            </div>

        </section>

    </main>



    {{-- ============================= --}}
    {{-- FOOTER --}}
    {{-- ============================= --}}

    <footer
        class="bg-[#2d1b14] py-12 text-[#f3e7dd]"
    >

        <div
            class="mx-auto flex max-w-7xl flex-col justify-between gap-8 px-6 md:flex-row"
        >

            <div>

                <h2
                    class="text-2xl font-black"
                >
                    Mood<span class="text-[#e8a87c]">
                        Crumb
                    </span>
                </h2>


                <p
                    class="mt-3 max-w-sm text-sm leading-6 text-[#c9ada0]"
                >
                    Cookies made for every feeling,
                    every moment, and every mood.
                </p>

            </div>


            <div
                class="text-sm text-[#c9ada0]"
            >
                © {{ date('Y') }} MoodCrumb.
                Made with 🍪 and feelings.
            </div>

        </div>

    </footer>

</body>
</html>