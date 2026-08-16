<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    >

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#07151a] text-white antialiased">

{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}

<header
    class="fixed inset-x-0 top-0 z-50 border-b border-[#5ccbd4]/15 bg-[#07151a]/75 backdrop-blur-xl"
>
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 sm:px-6 lg:px-8">

        {{-- BRAND --}}
        <a
            href="#"
            class="group flex items-center gap-4"
            aria-label="Cantigi Transport Services | Wanderlusth Cantigi Tour"
        >

            <div class="flex items-center gap-4">

                <img
                    src="{{ asset('images/logo-cantigi.png') }}"
                    alt="Cantigi Transport Services"
                    class="h-14 w-auto max-w-[185px] object-contain"
                >

                <div class="h-10 w-px bg-white/20"></div>

                <div class="leading-none">

                    <p class="text-base font-extrabold tracking-wide text-white sm:text-lg">
                        WANDERLUSTH
                    </p>

                    <p class="mt-1 text-[10px] font-semibold tracking-[0.28em] text-[#f28b50] sm:text-xs">
                        CANTIGI TOUR
                    </p>

                </div>

            </div>

        </a>


        {{-- DESKTOP NAVIGATION --}}
        <nav
            class="hidden items-center gap-8 md:flex"
            aria-label="Navigasi utama"
        >

            <a
                href="#armada"
                class="text-sm font-medium text-gray-300 transition hover:text-[#5ccbd4]"
            >
                Armada
            </a>

            <a
                href="#tentang-kami"
                class="text-sm font-medium text-gray-300 transition hover:text-[#5ccbd4]"
            >
                Tentang Kami
            </a>

            <a
                href="#keunggulan"
                class="text-sm font-medium text-gray-300 transition hover:text-[#5ccbd4]"
            >
                Keunggulan
            </a>

            <a
                href="#testimoni"
                class="text-sm font-medium text-gray-300 transition hover:text-[#5ccbd4]"
            >
                Testimoni
            </a>

        </nav>


        {{-- CTA --}}
        <a
            href="#armada"
            class="rounded-xl bg-[#f28b50] px-4 py-2.5 text-sm font-bold text-[#07151a] shadow-lg shadow-[#f28b50]/20 transition duration-300 hover:bg-[#e97838] hover:shadow-[#f28b50]/30"
        >
            Booking Sekarang
        </a>

    </div>
</header>



{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    class="relative overflow-hidden border-b border-[#5ccbd4]/15 bg-[#07151a]"
>

    {{-- DECORATIVE BACKGROUND --}}
    <div
        class="absolute -left-40 top-20 h-96 w-96 rounded-full bg-[#1ea6b2]/10 blur-3xl"
    ></div>

    <div
        class="absolute -right-40 bottom-0 h-96 w-96 rounded-full bg-[#f28b50]/10 blur-3xl"
    ></div>

    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(30,166,178,0.08),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(242,139,80,0.06),transparent_30%)]"
    ></div>


    {{-- HERO CONTENT --}}
    <div
        class="relative z-10 mx-auto max-w-7xl px-5 pb-20 pt-36 sm:px-6 lg:px-8 lg:pb-24 lg:pt-44"
    >

        <div class="grid items-center gap-14 lg:grid-cols-[1.15fr_0.85fr]">

            {{-- LEFT CONTENT --}}
            <div>

                {{-- EYEBROW --}}
                <div
                    class="mb-7 inline-flex items-center gap-3 rounded-full border border-[#5ccbd4]/15 bg-[#5ccbd4]/5 px-4 py-2"
                >

                    <span
                        class="h-2 w-2 rounded-full bg-[#1ea6b2] shadow-lg shadow-[#1ea6b2]/40"
                    ></span>

                    <span
                        class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-300"
                    >
                        Partner Perjalanan & Transportasi
                    </span>

                </div>


                {{-- TITLE --}}
                <h1
                    class="max-w-4xl text-5xl font-black leading-[1.02] tracking-tight sm:text-6xl lg:text-7xl"
                >

                    Solusi Perjalanan

                    <span class="block text-[#1ea6b2]">
                        yang Profesional.
                    </span>

                    <span class="block text-white">
                        Untuk Setiap Tujuan.
                    </span>

                </h1>


                {{-- DESCRIPTION --}}
                <p
                    class="mt-7 max-w-2xl text-base leading-7 text-gray-400 sm:text-lg"
                >
                    Wanderlusth Cantigi hadir sebagai mitra perjalanan
                    yang mengutamakan kualitas layanan, kenyamanan armada,
                    serta pengalaman perjalanan yang dapat diandalkan.
                </p>


                {{-- CTA --}}
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">

                    <a
                        href="#armada"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#f28b50] px-7 py-3.5 text-sm font-bold text-[#07151a] shadow-xl shadow-[#f28b50]/20 transition duration-300 hover:-translate-y-0.5 hover:bg-[#e97838]"
                    >
                        Lihat Armada

                        <span aria-hidden="true">
                            →
                        </span>
                    </a>

                    <a
                        href="#tentang-kami"
                        class="inline-flex items-center justify-center rounded-xl border border-[#5ccbd4]/20 bg-[#5ccbd4]/5 px-7 py-3.5 text-sm font-bold text-white transition duration-300 hover:bg-[#5ccbd4]/10"
                    >
                        Mengenal Kami
                    </a>

                </div>


                {{-- BUSINESS HIGHLIGHTS --}}
                <div class="mt-12 grid max-w-2xl grid-cols-2 gap-3 sm:grid-cols-4">

                    <div
                        class="rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b]/70 p-4"
                    >

                        <p class="text-2xl font-black text-[#1ea6b2]">
                            10+
                        </p>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Tahun Pengalaman
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b]/70 p-4"
                    >

                        <p class="text-2xl font-black text-[#f28b50]">
                            50+
                        </p>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Armada
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b]/70 p-4"
                    >

                        <p class="text-2xl font-black text-[#1ea6b2]">
                            10K+
                        </p>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Pelanggan
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b]/70 p-4"
                    >

                        <p class="text-2xl font-black text-[#f28b50]">
                            24/7
                        </p>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Layanan
                        </p>

                    </div>

                </div>

            </div>


            {{-- RIGHT BUSINESS CARD --}}
            <div class="relative">

                {{-- GLOW --}}
                <div
                    class="absolute -inset-6 rounded-[2rem] bg-[#1ea6b2]/5 blur-3xl"
                ></div>


                <div
                    class="relative overflow-hidden rounded-[2rem] border border-[#5ccbd4]/15 bg-[#0b1b20] p-6 shadow-2xl shadow-black/20 sm:p-8"
                >

                    {{-- CARD HEADER --}}
                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#1ea6b2]">
                                Wanderlusth Cantigi
                            </p>

                            <h2 class="mt-2 text-2xl font-black text-white sm:text-3xl">
                                Partner untuk perjalanan Anda.
                            </h2>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#f28b50]/10 text-[#f28b50]"
                        >
                            <i
                                class="fa-solid fa-chart-line"
                                aria-hidden="true"
                            ></i>
                        </div>

                    </div>


                    {{-- DIVIDER --}}
                    <div class="my-7 h-px bg-[#5ccbd4]/10"></div>


                    {{-- BUSINESS POINT 1 --}}
                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#1ea6b2]/10 text-[#1ea6b2]"
                        >
                            <i
                                class="fa-solid fa-shield-halved"
                                aria-hidden="true"
                            ></i>
                        </div>

                        <div>

                            <h3 class="font-bold text-white">
                                Mengutamakan Keamanan
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Armada dan layanan dirancang untuk memberikan
                                perjalanan yang aman dan nyaman.
                            </p>

                        </div>

                    </div>


                    {{-- BUSINESS POINT 2 --}}
                    <div class="mt-6 flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#f28b50]/10 text-[#f28b50]"
                        >
                            <i
                                class="fa-solid fa-briefcase"
                                aria-hidden="true"
                            ></i>
                        </div>

                        <div>

                            <h3 class="font-bold text-white">
                                Pelayanan Profesional
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Mendukung kebutuhan wisata, keluarga,
                                perusahaan, dan perjalanan rombongan.
                            </p>

                        </div>

                    </div>


                    {{-- BUSINESS POINT 3 --}}
                    <div class="mt-6 flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#1ea6b2]/10 text-[#1ea6b2]"
                        >
                            <i
                                class="fa-solid fa-handshake"
                                aria-hidden="true"
                            ></i>
                        </div>

                        <div>

                            <h3 class="font-bold text-white">
                                Mitra yang Dapat Diandalkan
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Memberikan pengalaman perjalanan dengan
                                pendekatan yang konsisten dan terpercaya.
                            </p>

                        </div>

                    </div>


                    {{-- BOTTOM ACCENT --}}
                    <div
                        class="mt-8 rounded-2xl border border-[#f28b50]/20 bg-[#f28b50]/5 p-5"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#f28b50] text-[#07151a]"
                            >
                                <i
                                    class="fa-solid fa-location-dot"
                                    aria-hidden="true"
                                ></i>
                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wider text-[#f28b50]">
                                    Berbasis di Padang
                                </p>

                                <p class="mt-1 text-sm text-gray-400">
                                    Melayani kebutuhan perjalanan Anda
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- TRUST STRIP --}}
{{-- ========================================================= --}}

<section class="border-y border-[#5ccbd4]/15 bg-[#0b1b20]">

    <div
        class="mx-auto grid max-w-7xl grid-cols-2 divide-x divide-[#5ccbd4]/15 sm:grid-cols-4"
    >

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


        <div class="border-t border-[#5ccbd4]/15 px-5 py-7 text-center sm:border-t-0">

            <p class="text-2xl font-black text-white">
                10K+
            </p>

            <p class="mt-1 text-xs uppercase tracking-wider text-gray-500">
                Pelanggan
            </p>

        </div>


        <div class="border-t border-[#5ccbd4]/15 px-5 py-7 text-center sm:border-t-0">

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

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-[#1ea6b2]">
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
                    class="group flex flex-col overflow-hidden rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b] transition duration-500 hover:-translate-y-1 hover:border-[#f28b50]/40 hover:shadow-2xl hover:shadow-black/30"
                >

                {{-- VISUAL ARMADA --}}
                <div class="relative h-56 overflow-hidden bg-[#081417] sm:h-64">
                
                    <img
                        src="{{ asset('images/hero-bus.png') }}"
                        alt="Armada {{ $armada->jenis_kendaraan }}"
                        class="h-full w-full object-cover object-center transition duration-700 group-hover:scale-105"
                    >
                
                    {{-- DARK OVERLAY --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[#07151a] via-[#07151a]/20 to-transparent"
                    ></div>
                
                    {{-- TOP GRADIENT --}}
                    <div
                        class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-black/30 to-transparent"
                    ></div>
                
                
                    {{-- STATUS --}}
                    <div class="absolute right-4 top-4">
                
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-[#5ccbd4]/20 bg-[#07151a]/80 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-[#5ccbd4] backdrop-blur-md"
                        >
                
                            <span class="h-1.5 w-1.5 rounded-full bg-[#5ccbd4]"></span>
                
                            Tersedia
                
                        </span>
                
                    </div>
                
                
                    {{-- CAPACITY BADGE --}}
                    <div class="absolute bottom-4 left-4">
                
                        <div
                            class="inline-flex items-center gap-3 rounded-xl border border-white/10 bg-[#07151a]/85 px-3.5 py-2.5 backdrop-blur-md"
                        >
                
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#1ea6b2]/15 text-[#5ccbd4]"
                            >
                                <i
                                    class="fa-solid fa-users"
                                    aria-hidden="true"
                                ></i>
                            </div>
                
                            <div>
                
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-500">
                                    Kapasitas
                                </p>
                
                                <p class="mt-0.5 text-sm font-bold text-white">
                                    {{ $armada->kapasitas ?? 0 }} Penumpang
                                </p>
                
                            </div>
                
                        </div>
                
                    </div>
                
                
                    {{-- IMAGE SHINE --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent opacity-0 transition duration-700 group-hover:translate-x-full group-hover:opacity-100"
                        style="transform: translateX(-100%);"
                    ></div>
                
                </div>


                    {{-- CONTENT --}}
                    {{-- CONTENT --}}
                    <div class="flex flex-1 flex-col p-6">
                    
                        <div>
                    
                            <div class="flex items-start justify-between gap-4">
                    
                                <h3 class="text-xl font-bold text-white">
                                    {{ $armada->jenis_kendaraan }}
                                </h3>
                    
                                <span
                                    class="shrink-0 rounded-full border border-[#f28b50]/25 bg-[#1ea6b2]/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-[#5ccbd4]"
                                >
                                    Tersedia
                                </span>
                    
                            </div>


                            {{-- ARMADA META --}}
<div class="mt-5 flex flex-wrap items-center gap-2">

    <span
        class="inline-flex items-center gap-2 rounded-lg border border-[#5ccbd4]/10 bg-[#5ccbd4]/5 px-2.5 py-1.5 text-xs text-gray-400"
    >
        <i
            class="fa-solid fa-bus text-[#1ea6b2]"
            aria-hidden="true"
        ></i>

        Bus Pariwisata
    </span>

    <span
        class="inline-flex items-center gap-2 rounded-lg border border-[#f28b50]/10 bg-[#f28b50]/5 px-2.5 py-1.5 text-xs text-gray-400"
    >
        <i
            class="fa-solid fa-user-group text-[#f28b50]"
            aria-hidden="true"
        ></i>

        {{ $armada->kapasitas ?? 0 }} Penumpang
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
                                            class="rounded-lg border border-[#5ccbd4]/10 bg-[#5ccbd4]/5 px-2.5 py-1.5 text-xs text-gray-300"
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
                        <div class="mt-8 border-t border-[#5ccbd4]/15 pt-5">

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
                                    class="flex items-center justify-center gap-2 rounded-xl bg-[#f28b50] px-4 py-3 text-sm font-bold text-[#07151a] transition duration-300 hover:bg-[#e97838]"
                                >
                                    Sewa Armada

                                    <span aria-hidden="true">
                                        →
                                    </span>

                                </a>

                            @else

                                <button
                                    disabled
                                    class="w-full cursor-not-allowed rounded-xl bg-[#15343a] px-4 py-3 text-sm font-semibold text-gray-500"
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

        <div
            class="rounded-2xl border border-dashed border-[#5ccbd4]/15 bg-[#10252b] py-20 text-center"
        >

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
    class="relative overflow-hidden border-y border-[#5ccbd4]/15 bg-[#0b1b20] py-24"
>

    <div
        class="absolute -right-40 top-20 h-96 w-96 rounded-full bg-[#1ea6b2]/5 blur-3xl"
    ></div>


    <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mx-auto mb-16 max-w-3xl text-center">

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-[#1ea6b2]">
                Tentang Kami
            </p>

            <h2 class="text-3xl font-black sm:text-4xl">

                Lebih Dari Sekadar

                <span class="text-[#1ea6b2]">
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
                    class="absolute -inset-4 rounded-3xl bg-[#1ea6b2]/5 blur-2xl"
                ></div>

                <div
                    class="relative overflow-hidden rounded-3xl border border-[#5ccbd4]/15 bg-[#10252b]"
                >

                    <img
                        src="{{ asset('images/hero-bus.png') }}"
                        alt="Armada bus Wanderlusth Cantigi"
                        class="h-[420px] w-full object-cover"
                    >

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[#07151a] via-transparent to-transparent"
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

                <p class="text-sm font-bold uppercase tracking-[0.2em] text-[#1ea6b2]">
                    PT Wanderlusth Cantigi International
                </p>

                <h3 class="mt-4 text-3xl font-black leading-tight sm:text-4xl">

                    Partner terpercaya untuk

                    <span class="text-[#1ea6b2]">
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

                    <div
                        class="rounded-xl border border-[#5ccbd4]/15 bg-[#5ccbd4]/[0.03] p-4"
                    >

                        <p class="text-2xl font-black text-[#1ea6b2]">
                            10+
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Tahun pengalaman
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-[#5ccbd4]/15 bg-[#5ccbd4]/[0.03] p-4"
                    >

                        <p class="text-2xl font-black text-[#1ea6b2]">
                            50+
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Armada
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-[#5ccbd4]/15 bg-[#5ccbd4]/[0.03] p-4"
                    >

                        <p class="text-2xl font-black text-[#1ea6b2]">
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
                class="rounded-2xl border border-[#5ccbd4]/15 bg-[#07151a] p-8"
            >

                <div class="flex items-start gap-5">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#1ea6b2]/10 text-[#1ea6b2]"
                    >
                        🎯
                    </div>

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-[#1ea6b2]">
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
                class="rounded-2xl border border-[#5ccbd4]/15 bg-[#07151a] p-8"
            >

                <div class="flex items-start gap-5">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#1ea6b2]/10 text-[#1ea6b2]"
                    >
                        ✓
                    </div>

                    <div class="w-full">

                        <p class="text-xs font-bold uppercase tracking-wider text-[#1ea6b2]">
                            Komitmen Kami
                        </p>

                        <h3 class="mt-1 text-2xl font-bold">
                            Misi
                        </h3>

                        <ul class="mt-4 space-y-3 text-sm leading-6 text-gray-400">

                            <li class="flex gap-3">
                                <span class="text-[#1ea6b2]">✓</span>

                                <span>
                                    Menyediakan layanan transportasi
                                    yang aman dan nyaman.
                                </span>
                            </li>

                            <li class="flex gap-3">
                                <span class="text-[#1ea6b2]">✓</span>

                                <span>
                                    Memberikan harga yang kompetitif
                                    dan transparan.
                                </span>
                            </li>

                            <li class="flex gap-3">
                                <span class="text-[#1ea6b2]">✓</span>

                                <span>
                                    Mengutamakan kepuasan pelanggan.
                                </span>
                            </li>

                            <li class="flex gap-3">
                                <span class="text-[#1ea6b2]">✓</span>

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

        <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-[#1ea6b2]">
            Mengapa Kami
        </p>

        <h2 class="text-3xl font-black sm:text-4xl">

            Dibuat Untuk Memberikan

            <span class="text-[#1ea6b2]">
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
            class="group rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b] p-8 transition duration-300 hover:-translate-y-1 hover:border-[#f28b50]/40"
        >

            <div
                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#1ea6b2]/10 text-2xl transition duration-300 group-hover:bg-[#1ea6b2] group-hover:text-white"
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
            class="group rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b] p-8 transition duration-300 hover:-translate-y-1 hover:border-[#f28b50]/40"
        >

            <div
                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#1ea6b2]/10 text-2xl transition duration-300 group-hover:bg-[#1ea6b2] group-hover:text-white"
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
            class="group rounded-2xl border border-[#5ccbd4]/15 bg-[#10252b] p-8 transition duration-300 hover:-translate-y-1 hover:border-[#f28b50]/40"
        >

            <div
                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#1ea6b2]/10 text-2xl transition duration-300 group-hover:bg-[#1ea6b2] group-hover:text-white"
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
    class="border-y border-[#5ccbd4]/15 bg-[#0b1b20] py-24"
>

    <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">

        <div class="mx-auto mb-12 max-w-2xl text-center">

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-[#1ea6b2]">
                Testimoni
            </p>

            <h2 class="text-3xl font-black sm:text-4xl">

                Dipercaya Dalam

                <span class="text-[#1ea6b2]">
                    Setiap Perjalanan
                </span>

            </h2>

        </div>


        <div class="grid gap-6 md:grid-cols-2">

            {{-- TESTIMONI 1 --}}
            <div
                class="rounded-2xl border border-[#5ccbd4]/15 bg-[#07151a] p-8"
            >

                <div class="text-3xl text-[#1ea6b2]">
                    “
                </div>

                <blockquote class="mt-4 text-lg leading-8 text-gray-300">
                    Pelayanan cepat dan armada sangat nyaman.
                </blockquote>

                <div class="mt-6 border-t border-[#5ccbd4]/10 pt-5">

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
                class="rounded-2xl border border-[#5ccbd4]/15 bg-[#07151a] p-8"
            >

                <div class="text-3xl text-[#1ea6b2]">
                    “
                </div>

                <blockquote class="mt-4 text-lg leading-8 text-gray-300">
                    Driver ramah dan perjalanan terasa aman.
                </blockquote>

                <div class="mt-6 border-t border-[#5ccbd4]/10 pt-5">

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
        class="absolute inset-0 bg-gradient-to-br from-[#1ea6b2]/10 via-transparent to-transparent"
    ></div>

    <div
        class="relative mx-auto max-w-4xl px-5 text-center sm:px-6"
    >

        <p class="text-xs font-bold uppercase tracking-[0.25em] text-[#1ea6b2]">
            Mulai Perjalanan Anda
        </p>

        <h2 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl">

            Siap Menjelajah

            <span class="text-[#1ea6b2]">
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
                    class="inline-flex items-center gap-2 rounded-xl bg-[#f28b50] px-7 py-3.5 text-sm font-bold text-[#07151a] shadow-xl shadow-[#f28b50]/20 transition duration-300 hover:-translate-y-0.5 hover:bg-[#e97838]"
                >
                    Mulai Booking

                    <span aria-hidden="true">
                        →
                    </span>
                </a>

            @else

                <button
                    disabled
                    class="cursor-not-allowed rounded-xl bg-[#15343a] px-7 py-3.5 text-sm font-bold text-gray-500"
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

<footer class="border-t border-[#5ccbd4]/15 bg-[#061014]">

    <div
        class="mx-auto grid max-w-7xl gap-8 px-5 py-10 sm:px-6 md:grid-cols-3 lg:px-8"
    >

        {{-- BRAND --}}
        <div>

            <p class="font-extrabold tracking-wide text-white">
                WANDERLUSTH
            </p>

            <p class="mt-1 text-xs font-semibold tracking-[0.2em] text-[#f28b50]">
                CANTIGI TOUR
            </p>

            <p class="mt-3 max-w-sm text-xs leading-5 text-gray-500">
                Partner perjalanan terpercaya untuk kebutuhan
                transportasi dan perjalanan Anda.
            </p>

        </div>


        {{-- NAVIGASI --}}
        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">
                Navigasi
            </p>

            <div class="mt-4 flex flex-col gap-3 text-xs text-gray-500">

                <a
                    href="#armada"
                    class="w-fit transition hover:text-[#5ccbd4]"
                >
                    Armada
                </a>

                <a
                    href="#tentang-kami"
                    class="w-fit transition hover:text-[#5ccbd4]"
                >
                    Tentang Kami
                </a>

                <a
                    href="#keunggulan"
                    class="w-fit transition hover:text-[#5ccbd4]"
                >
                    Keunggulan
                </a>

                <a
                    href="#testimoni"
                    class="w-fit transition hover:text-[#5ccbd4]"
                >
                    Testimoni
                </a>

            </div>

        </div>


        {{-- CONTACT US --}}
        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">
                Contact Us
            </p>

            <div class="mt-4 space-y-4">

                {{-- WHATSAPP --}}
                <a
                    href="https://wa.me/6285356969541"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="group flex items-start gap-3"
                    aria-label="Hubungi Wanderlusth Cantigi melalui WhatsApp"
                >

                    <span
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#25D366]/10 text-xl text-[#25D366] transition duration-300 group-hover:bg-[#25D366] group-hover:text-white"
                    >
                        <i
                            class="fa-brands fa-whatsapp"
                            aria-hidden="true"
                        ></i>
                    </span>

                    <span>

                        <span class="block text-sm font-semibold text-white">
                            WhatsApp
                        </span>

                        <span class="mt-1 block text-xs leading-5 text-gray-500 transition group-hover:text-gray-300">
                            +62 853-5696-9541
                        </span>

                    </span>

                </a>


                {{-- ALAMAT KANTOR --}}
                <div class="flex items-start gap-3">

                    <span
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#f28b50]/10 text-lg text-[#f28b50]"
                    >
                        <i
                            class="fa-solid fa-location-dot"
                            aria-hidden="true"
                        ></i>
                    </span>

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Alamat Kantor
                        </p>

                        <p class="mt-1 max-w-sm text-xs leading-5 text-gray-500">
                            Padang, Sumatera Barat
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="border-t border-[#5ccbd4]/10">

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