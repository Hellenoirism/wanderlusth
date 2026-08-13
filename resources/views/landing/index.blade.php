<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">

    <title>
        Wanderlusth Cantigi Tour | Sewa Bus Pariwisata Padang
    </title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Wanderlusth Cantigi menyediakan layanan sewa bus pariwisata dengan armada terawat, pelayanan profesional, dan sistem reservasi yang mudah."
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-[#070b14] text-white antialiased">

{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}

<header
    class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#070b14]/75 backdrop-blur-xl"
>
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 sm:px-6 lg:px-8">

        {{-- BRAND --}}
        <a
            href="#"
            class="group flex items-center gap-3"
            aria-label="Wanderlusth Cantigi"
        >

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-600 font-black shadow-lg shadow-red-600/20"
            >
                W
            </div>

            <div class="leading-none">
                <p class="text-sm font-extrabold tracking-wide text-white">
                    WANDERLUSTH
                </p>

                <p class="mt-1 text-[10px] font-semibold tracking-[0.25em] text-red-500">
                    CANTIGI TOUR
                </p>
            </div>

        </a>


        {{-- DESKTOP NAVIGATION --}}
        <nav
            class="hidden items-center gap-8 md:flex"
            aria-label="Navigasi utama"
        >

            <a
                href="#armada"
                class="text-sm font-medium text-gray-300 transition hover:text-white"
            >
                Armada
            </a>

            <a
                href="#tentang-kami"
                class="text-sm font-medium text-gray-300 transition hover:text-white"
            >
                Tentang Kami
            </a>

            <a
                href="#keunggulan"
                class="text-sm font-medium text-gray-300 transition hover:text-white"
            >
                Keunggulan
            </a>

            <a
                href="#testimoni"
                class="text-sm font-medium text-gray-300 transition hover:text-white"
            >
                Testimoni
            </a>

        </nav>


        {{-- CTA --}}
        <a
            href="#armada"
            class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold shadow-lg shadow-red-600/20 transition duration-300 hover:bg-red-700 hover:shadow-red-600/30"
        >
            Booking Sekarang
        </a>

    </div>
</header>


{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    class="relative flex min-h-screen items-center overflow-hidden"
>

    {{-- HERO IMAGE --}}
    <div class="absolute inset-0">

        <img
            src="{{ asset('images/hero-bus.png') }}"
            alt="Bus pariwisata Wanderlusth Cantigi"
            class="h-full w-full object-cover object-center"
        >

        {{-- DARK OVERLAY --}}
        <div class="absolute inset-0 bg-[#070b14]/70"></div>

        {{-- LEFT GRADIENT --}}
        <div
            class="absolute inset-0 bg-gradient-to-r from-[#070b14] via-[#070b14]/90 to-[#070b14]/20"
        ></div>

        {{-- BOTTOM GRADIENT --}}
        <div
            class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-[#070b14] to-transparent"
        ></div>

    </div>


    {{-- DECORATIVE GLOW --}}
    <div
        class="absolute -left-32 top-1/3 h-72 w-72 rounded-full bg-red-600/10 blur-3xl"
    ></div>


    {{-- HERO CONTENT --}}
    <div
        class="relative z-10 mx-auto w-full max-w-7xl px-5 pb-20 pt-32 sm:px-6 lg:px-8"
    >

        <div class="max-w-3xl">

            {{-- EYEBROW --}}
            <div
                class="mb-6 inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-2 backdrop-blur-md"
            >

                <span class="h-2 w-2 rounded-full bg-red-500 shadow-lg shadow-red-500/50"></span>

                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-300">
                    Partner Perjalanan Anda
                </span>

            </div>


            {{-- TITLE --}}
            <h1
                class="text-5xl font-black leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl"
            >

                Perjalanan Nyaman.

                <span class="block text-red-500">
                    Pengalaman Berkesan.
                </span>

            </h1>


            {{-- DESCRIPTION --}}
            <p
                class="mt-7 max-w-2xl text-base leading-7 text-gray-300 sm:text-lg"
            >
                Nikmati perjalanan bersama armada bus pariwisata yang
                terawat, nyaman, dan didukung pelayanan profesional
                untuk kebutuhan wisata, keluarga, perusahaan, maupun
                perjalanan rombongan Anda.
            </p>


            {{-- CTA --}}
            <div class="mt-9 flex flex-col gap-3 sm:flex-row">

                <a
                    href="#armada"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-7 py-3.5 text-sm font-bold shadow-xl shadow-red-600/20 transition duration-300 hover:-translate-y-0.5 hover:bg-red-700"
                >
                    Lihat Armada

                    <span aria-hidden="true">
                        →
                    </span>
                </a>

                <a
                    href="#tentang-kami"
                    class="inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/5 px-7 py-3.5 text-sm font-bold backdrop-blur-sm transition duration-300 hover:bg-white/10"
                >
                    Tentang Kami
                </a>

            </div>


            {{-- HERO TRUST --}}
            <div class="mt-12 flex flex-wrap gap-x-8 gap-y-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10">
                        ✓
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">
                            Armada Terawat
                        </p>

                        <p class="text-xs text-gray-400">
                            Siap menemani perjalanan
                        </p>
                    </div>

                </div>


                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10">
                        ✓
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">
                            Driver Profesional
                        </p>

                        <p class="text-xs text-gray-400">
                            Mengutamakan keselamatan
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SCROLL INDICATOR --}}
    <a
        href="#armada"
        class="absolute bottom-8 left-1/2 hidden -translate-x-1/2 flex-col items-center gap-2 text-xs text-gray-500 transition hover:text-white md:flex"
        aria-label="Scroll ke armada"
    >
        <span>Scroll untuk menjelajah</span>

        <span class="text-lg">
            ↓
        </span>
    </a>

</section>


{{-- ========================================================= --}}
{{-- TRUST STRIP --}}
{{-- ========================================================= --}}

<section class="border-y border-white/10 bg-[#0b101c]">

    <div class="mx-auto grid max-w-7xl grid-cols-2 divide-x divide-white/10 sm:grid-cols-4">

        <div class="px-5 py-7 text-center">

            <p class="text-2xl font-black text-white">
                10+
            </p>

            <p class="mt-1 text-xs uppercase tracking-wider text-gray-500">
                Tahun Pengalaman
            </p>

        </div>


        <div class="px-5 py-7 text-center">

            <p class="text-2xl font-black text-white">
                50+
            </p>

            <p class="mt-1 text-xs uppercase tracking-wider text-gray-500">
                Armada
            </p>

        </div>


        <div class="border-t border-white/10 px-5 py-7 text-center sm:border-t-0">

            <p class="text-2xl font-black text-white">
                10K+
            </p>

            <p class="mt-1 text-xs uppercase tracking-wider text-gray-500">
                Pelanggan
            </p>

        </div>


        <div class="border-t border-white/10 px-5 py-7 text-center sm:border-t-0">

            <p class="text-2xl font-black text-white">
                24/7
            </p>

            <p class="mt-1 text-xs uppercase tracking-wider text-gray-500">
                Layanan
            </p>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- ARMADA --}}
{{-- ========================================================= --}}

<section
    id="armada"
    class="mx-auto max-w-7xl px-5 py-24 sm:px-6 lg:px-8"
>

    {{-- SECTION HEADER --}}
    <div class="mb-14 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">

        <div class="max-w-2xl">

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-red-500">
                Fleet Kami
            </p>

            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">
                Pilihan Armada
                <span class="text-gray-500">
                    Untuk Setiap Perjalanan
                </span>
            </h2>

            <p class="mt-4 leading-7 text-gray-400">
                Pilih armada sesuai kapasitas dan kebutuhan perjalanan
                Anda dengan fasilitas yang mendukung kenyamanan selama
                perjalanan.
            </p>

        </div>

        <div class="hidden text-right md:block">

            <p class="text-sm text-gray-500">
                Armada tersedia
            </p>

            <p class="mt-1 text-2xl font-bold">
                {{ isset($armadas) ? $armadas->count() : 0 }}
            </p>

        </div>

    </div>


    @if(isset($armadas) && $armadas->count())

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            @foreach ($armadas as $armada)

                <article
                    class="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-[#0d1320] transition duration-500 hover:-translate-y-1 hover:border-red-500/30 hover:shadow-2xl hover:shadow-black/30"
                >

                    {{-- VISUAL HEADER --}}
                    <div
                        class="relative flex h-48 items-center justify-center overflow-hidden bg-gradient-to-br from-slate-800 to-slate-950"
                    >

                        <div
                            class="absolute h-32 w-32 rounded-full bg-red-600/10 blur-3xl transition duration-500 group-hover:bg-red-600/20"
                        ></div>

                        <div class="relative text-center">

                            <div class="text-5xl opacity-80 transition duration-500 group-hover:scale-110">
                                🚌
                            </div>

                            <p class="mt-3 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">
                                Bus Pariwisata
                            </p>

                        </div>

                        <div
                            class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#0d1320] to-transparent"
                        ></div>

                    </div>


                    {{-- CONTENT --}}
                    <div class="flex flex-1 flex-col p-6">

                        <div>

                            <div class="flex items-start justify-between gap-4">

                                <h3 class="text-xl font-bold text-white">
                                    {{ $armada->jenis_kendaraan }}
                                </h3>

                                <span
                                    class="shrink-0 rounded-full border border-red-500/20 bg-red-500/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-red-400"
                                >
                                    Tersedia
                                </span>

                            </div>


                            {{-- CAPACITY --}}
                            <div class="mt-4 flex items-center gap-2 text-sm text-gray-400">

                                <span class="text-red-500">
                                    👥
                                </span>

                                <span>
                                    Kapasitas
                                    <strong class="text-gray-200">
                                        {{ $armada->kapasitas ?? 0 }} orang
                                    </strong>
                                </span>

                            </div>


                            {{-- FACILITIES --}}
                            <div class="mt-5">

                                <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Fasilitas
                                </p>

                                <div class="flex flex-wrap gap-2">

                                    @forelse ($armada->fasilitas as $fasilitas)

                                        <span
                                            class="rounded-lg border border-white/5 bg-white/5 px-2.5 py-1.5 text-xs text-gray-300"
                                        >
                                            {{ $fasilitas->nama_fasilitas }}
                                        </span>

                                    @empty

                                        <span class="text-xs italic text-gray-600">
                                            Tidak ada fasilitas
                                        </span>

                                    @endforelse

                                </div>

                            </div>

                        </div>


                        {{-- CARD FOOTER --}}
                        <div class="mt-8 border-t border-white/10 pt-5">

                            <div class="mb-4">

                                <p class="text-xs text-gray-500">
                                    Harga sewa
                                </p>

                                <p class="mt-1 text-xl font-black text-white">

                                    Rp
                                    {{ number_format($armada->harga_sewa ?? 0, 0, ',', '.') }}

                                </p>

                            </div>


                            @if($armada?->id_armada)

                                <a
                                    href="{{ route('reservasi.create', ['armada' => $armada->id_armada]) }}"
                                    class="flex items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-3 text-sm font-bold transition duration-300 hover:bg-red-700"
                                >
                                    Sewa Armada

                                    <span aria-hidden="true">
                                        →
                                    </span>
                                </a>

                            @else

                                <button
                                    disabled
                                    class="w-full cursor-not-allowed rounded-xl bg-slate-800 px-4 py-3 text-sm font-semibold text-gray-500"
                                >
                                    Armada Belum Tersedia
                                </button>

                            @endif

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="rounded-2xl border border-dashed border-white/10 bg-[#0d1320] py-20 text-center">

            <div class="text-4xl">
                🚌
            </div>

            <h3 class="mt-4 text-xl font-bold text-gray-300">
                Armada Belum Tersedia
            </h3>

            <p class="mt-2 text-sm text-gray-500">
                Saat ini belum ada armada yang ditambahkan ke sistem.
            </p>

        </div>

    @endif

</section>


{{-- ========================================================= --}}
{{-- TENTANG KAMI --}}
{{-- ========================================================= --}}

<section
    id="tentang-kami"
    class="relative overflow-hidden border-y border-white/10 bg-[#0b101c] py-24"
>

    <div
        class="absolute -right-40 top-20 h-96 w-96 rounded-full bg-red-600/5 blur-3xl"
    ></div>


    <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mx-auto mb-16 max-w-3xl text-center">

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-red-500">
                Tentang Kami
            </p>

            <h2 class="text-3xl font-black sm:text-4xl">
                Lebih Dari Sekadar
                <span class="text-red-500">
                    Transportasi
                </span>
            </h2>

            <p class="mt-5 leading-7 text-gray-400">
                Kami hadir untuk membantu setiap perjalanan menjadi
                lebih nyaman, aman, dan berkesan.
            </p>

        </div>


        {{-- PROFILE --}}
        <div class="grid items-center gap-12 lg:grid-cols-2">

            {{-- IMAGE --}}
            <div class="relative">

                <div
                    class="absolute -inset-4 rounded-3xl bg-red-600/5 blur-2xl"
                ></div>

                <div
                    class="relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900"
                >

                    <img
                        src="{{ asset('images/hero-bus.png') }}"
                        alt="Armada bus Wanderlusth Cantigi"
                        class="h-[420px] w-full object-cover"
                    >

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[#070b14] via-transparent to-transparent"
                    ></div>


                    <div class="absolute bottom-6 left-6">

                        <p class="text-4xl font-black text-white">
                            2010
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-300">
                            Memulai perjalanan bersama pelanggan
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div>

                <p class="text-sm font-bold uppercase tracking-[0.2em] text-red-500">
                    PT Wanderlusth Cantigi International
                </p>

                <h3 class="mt-4 text-3xl font-black leading-tight sm:text-4xl">

                    Partner terpercaya untuk
                    <span class="text-red-500">
                        perjalanan Anda.
                    </span>

                </h3>

                <div class="mt-6 space-y-5 leading-7 text-gray-400">

                    <p>
                        Kami merupakan perusahaan yang bergerak dalam
                        layanan Tour, Travel, dan Rental Kendaraan
                        untuk berbagai kebutuhan perjalanan.
                    </p>

                    <p>
                        Dengan mengutamakan keamanan, kenyamanan, dan
                        pelayanan profesional, kami berkomitmen untuk
                        memberikan pengalaman perjalanan yang dapat
                        diandalkan oleh setiap pelanggan.
                    </p>

                </div>


                {{-- MINI STATS --}}
                <div class="mt-9 grid grid-cols-3 gap-3">

                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-4">

                        <p class="text-2xl font-black text-red-500">
                            10+
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Tahun pengalaman
                        </p>

                    </div>


                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-4">

                        <p class="text-2xl font-black text-red-500">
                            50+
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Armada
                        </p>

                    </div>


                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-4">

                        <p class="text-2xl font-black text-red-500">
                            10K+
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Pelanggan
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- VISI MISI --}}
        <div class="mt-20 grid gap-6 lg:grid-cols-2">

            {{-- VISI --}}
            <div
                class="rounded-2xl border border-white/10 bg-[#070b14] p-8"
            >

                <div class="flex items-start gap-5">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-500"
                    >
                        🎯
                    </div>

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-red-500">
                            Arah Kami
                        </p>

                        <h3 class="mt-1 text-2xl font-bold">
                            Visi
                        </h3>

                        <p class="mt-4 leading-7 text-gray-400">
                            Menjadi perusahaan tour dan travel terdepan
                            di Sumatera Barat serta menjadi pilihan utama
                            bagi wisatawan domestik maupun mancanegara.
                        </p>

                    </div>

                </div>

            </div>


            {{-- MISI --}}
            <div
                class="rounded-2xl border border-white/10 bg-[#070b14] p-8"
            >

                <div class="flex items-start gap-5">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-500"
                    >
                        ✓
                    </div>

                    <div class="w-full">

                        <p class="text-xs font-bold uppercase tracking-wider text-red-500">
                            Komitmen Kami
                        </p>

                        <h3 class="mt-1 text-2xl font-bold">
                            Misi
                        </h3>

                        <ul class="mt-4 space-y-3 text-sm leading-6 text-gray-400">

                            <li class="flex gap-3">
                                <span class="text-red-500">✓</span>
                                <span>
                                    Menyediakan layanan transportasi
                                    yang aman dan nyaman.
                                </span>
                            </li>

                            <li class="flex gap-3">
                                <span class="text-red-500">✓</span>
                                <span>
                                    Memberikan harga yang kompetitif
                                    dan transparan.
                                </span>
                            </li>

                            <li class="flex gap-3">
                                <span class="text-red-500">✓</span>
                                <span>
                                    Mengutamakan kepuasan pelanggan.
                                </span>
                            </li>

                            <li class="flex gap-3">
                                <span class="text-red-500">✓</span>
                                <span>
                                    Membangun hubungan jangka panjang
                                    dengan pelanggan dan stakeholder.
                                </span>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- KEUNGGULAN --}}
{{-- ========================================================= --}}

<section
    id="keunggulan"
    class="mx-auto max-w-7xl px-5 py-24 sm:px-6 lg:px-8"
>

    <div class="mx-auto mb-14 max-w-3xl text-center">

        <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-red-500">
            Mengapa Kami
        </p>

        <h2 class="text-3xl font-black sm:text-4xl">
            Dibuat Untuk Memberikan
            <span class="text-red-500">
                Perjalanan Terbaik
            </span>
        </h2>

        <p class="mt-5 leading-7 text-gray-400">
            Setiap detail perjalanan kami dirancang untuk memberikan
            rasa aman, nyaman, dan pelayanan yang dapat diandalkan.
        </p>

    </div>


    <div class="grid gap-6 md:grid-cols-3">

        {{-- CARD --}}
        <div
            class="group rounded-2xl border border-white/10 bg-[#0d1320] p-8 transition duration-300 hover:-translate-y-1 hover:border-red-500/30"
        >

            <div
                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/10 text-2xl transition duration-300 group-hover:bg-red-500 group-hover:text-white"
            >
                🚌
            </div>

            <h3 class="mt-6 text-xl font-bold">
                Armada Terawat
            </h3>

            <p class="mt-3 text-sm leading-6 text-gray-400">
                Armada dirawat secara berkala untuk mendukung
                perjalanan yang nyaman dan aman.
            </p>

        </div>


        {{-- CARD --}}
        <div
            class="group rounded-2xl border border-white/10 bg-[#0d1320] p-8 transition duration-300 hover:-translate-y-1 hover:border-red-500/30"
        >

            <div
                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/10 text-2xl transition duration-300 group-hover:bg-red-500 group-hover:text-white"
            >
                👨‍✈️
            </div>

            <h3 class="mt-6 text-xl font-bold">
                Pelayanan Profesional
            </h3>

            <p class="mt-3 text-sm leading-6 text-gray-400">
                Kami mengutamakan pelayanan profesional agar
                perjalanan Anda berjalan dengan lancar.
            </p>

        </div>


        {{-- CARD --}}
        <div
            class="group rounded-2xl border border-white/10 bg-[#0d1320] p-8 transition duration-300 hover:-translate-y-1 hover:border-red-500/30"
        >

            <div
                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/10 text-2xl transition duration-300 group-hover:bg-red-500 group-hover:text-white"
            >
                💳
            </div>

            <h3 class="mt-6 text-xl font-bold">
                Harga Transparan
            </h3>

            <p class="mt-3 text-sm leading-6 text-gray-400">
                Informasi harga yang jelas membantu Anda menentukan
                pilihan sesuai kebutuhan dan anggaran.
            </p>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- TESTIMONI --}}
{{-- ========================================================= --}}

<section
    id="testimoni"
    class="border-y border-white/10 bg-[#0b101c] py-24"
>

    <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">

        <div class="mx-auto mb-12 max-w-2xl text-center">

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-red-500">
                Testimoni
            </p>

            <h2 class="text-3xl font-black sm:text-4xl">
                Dipercaya Dalam
                <span class="text-red-500">
                    Setiap Perjalanan
                </span>
            </h2>

        </div>


        <div class="grid gap-6 md:grid-cols-2">

            {{-- TESTIMONI 1 --}}
            <div
                class="rounded-2xl border border-white/10 bg-[#070b14] p-8"
            >

                <div class="text-3xl text-red-500">
                    “
                </div>

                <blockquote class="mt-4 text-lg leading-8 text-gray-300">
                    Pelayanan cepat dan armada sangat nyaman.
                </blockquote>

                <div class="mt-6 border-t border-white/10 pt-5">

                    <p class="font-bold">
                        Andi
                    </p>

                    <p class="mt-1 text-xs text-gray-500">
                        Pelanggan
                    </p>

                </div>

            </div>


            {{-- TESTIMONI 2 --}}
            <div
                class="rounded-2xl border border-white/10 bg-[#070b14] p-8"
            >

                <div class="text-3xl text-red-500">
                    “
                </div>

                <blockquote class="mt-4 text-lg leading-8 text-gray-300">
                    Driver ramah dan perjalanan terasa aman.
                </blockquote>

                <div class="mt-6 border-t border-white/10 pt-5">

                    <p class="font-bold">
                        Sinta
                    </p>

                    <p class="mt-1 text-xs text-gray-500">
                        Pelanggan
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- FINAL CTA --}}
{{-- ========================================================= --}}

<section class="relative overflow-hidden py-24">

    <div
        class="absolute inset-0 bg-gradient-to-br from-red-600/10 via-transparent to-transparent"
    ></div>

    <div
        class="relative mx-auto max-w-4xl px-5 text-center sm:px-6"
    >

        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-500">
            Mulai Perjalanan Anda
        </p>

        <h2 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl">
            Siap Menjelajah
            <span class="text-red-500">
                Bersama Kami?
            </span>
        </h2>

        <p class="mx-auto mt-5 max-w-2xl leading-7 text-gray-400">
            Pilih armada yang sesuai dengan kebutuhan perjalanan Anda
            dan lakukan reservasi dengan mudah.
        </p>


        <div class="mt-8">

            @if(isset($armadas) && $armadas->count())

                <a
                    href="#armada"
                    class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-7 py-3.5 text-sm font-bold shadow-xl shadow-red-600/20 transition duration-300 hover:-translate-y-0.5 hover:bg-red-700"
                >
                    Mulai Booking

                    <span aria-hidden="true">
                        →
                    </span>
                </a>

            @else

                <button
                    disabled
                    class="cursor-not-allowed rounded-xl bg-slate-800 px-7 py-3.5 text-sm font-bold text-gray-500"
                >
                    Armada Belum Tersedia
                </button>

            @endif

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer class="border-t border-white/10 bg-[#04060b]">

    <div
        class="mx-auto flex max-w-7xl flex-col gap-6 px-5 py-10 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8"
    >

        {{-- BRAND --}}
        <div>

            <p class="font-extrabold tracking-wide">
                WANDERLUSTH
            </p>

            <p class="mt-1 text-xs font-semibold tracking-[0.2em] text-red-500">
                CANTIGI TOUR
            </p>

            <p class="mt-3 max-w-sm text-xs leading-5 text-gray-600">
                Partner perjalanan terpercaya untuk kebutuhan
                transportasi dan perjalanan Anda.
            </p>

        </div>


        {{-- LINKS --}}
        <div class="flex flex-wrap gap-6 text-xs text-gray-500">

            <a
                href="#armada"
                class="transition hover:text-white"
            >
                Armada
            </a>

            <a
                href="#tentang-kami"
                class="transition hover:text-white"
            >
                Tentang Kami
            </a>

            <a
                href="#keunggulan"
                class="transition hover:text-white"
            >
                Keunggulan
            </a>

            <a
                href="#testimoni"
                class="transition hover:text-white"
            >
                Testimoni
            </a>

        </div>

    </div>


    <div class="border-t border-white/5">

        <div
            class="mx-auto max-w-7xl px-5 py-5 text-xs text-gray-600 sm:px-6 lg:px-8"
        >

            &copy; {{ date('Y') }}
            Wanderlusth Cantigi Tour.
            All rights reserved.

        </div>

    </div>

</footer>

</body>
</html>