<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Wanderlusth Cantigi Tour</title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-[#070b14] text-white antialiased">

{{-- NAVBAR --}}
<header class="fixed top-0 z-50 w-full bg-slate-900/80 backdrop-blur">

    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        <h1 class="text-xl font-bold text-red-500">
            Wanderlusth Cantigi
        </h1>

        <a
            href="#armada"
            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold transition hover:bg-red-700"
        >
            Booking Sekarang
        </a>

    </div>

</header>

{{-- HERO --}}
<section class="flex h-screen items-center justify-center px-6 text-center">

    <div class="max-w-3xl">

        <h2 class="mb-6 text-5xl font-extrabold leading-tight md:text-6xl">

            Sewa Bus Nyaman & Aman
            <br>

            <span class="text-red-500">
                Untuk Semua Perjalanan Anda
            </span>

        </h2>

        <p class="mb-8 text-gray-400">

            Armada terawat, driver profesional,
            dan sistem booking fleksibel sesuai kebutuhan Anda.

        </p>

        <div class="flex justify-center gap-4">

            <a
                href="#armada"
                class="rounded-lg bg-red-600 px-6 py-3 font-semibold transition hover:bg-red-700"
            >
                Booking Sekarang
            </a>

            <a
                href="#armada"
                class="rounded-lg border border-gray-600 px-6 py-3 transition hover:bg-white/5"
            >
                Lihat Armada
            </a>

        </div>

    </div>

</section>

{{-- TRUST --}}
<section class="border-t border-white/10 py-10 text-center">

    <p class="text-sm text-gray-400">

        Dipercaya oleh berbagai perusahaan & instansi

    </p>

</section>

{{-- ARMADA --}}
<section
    id="armada"
    class="mx-auto max-w-7xl px-6 py-16"
>

    <h3 class="mb-10 text-center text-3xl font-bold">

        Armada Pilihan

    </h3>

    @if(isset($armadas) && $armadas->count())

        <div class="grid gap-8 md:grid-cols-3">

            @foreach ($armadas as $armada)

                <div class="flex flex-col justify-between rounded-2xl bg-slate-900 p-6 transition duration-300 hover:scale-[1.03]">

                    <div>

                        <h4 class="mb-2 text-xl font-bold">

                            {{ $armada->jenis_kendaraan }}

                        </h4>

                        <p class="mb-2 text-sm text-gray-400">

                            Kapasitas:
                            {{ $armada->kapasitas ?? 0 }}
                            Orang

                        </p>

                        {{-- FASILITAS --}}
                        <div class="mb-4 flex flex-wrap gap-2">

                            @forelse ($armada->fasilitas as $fasilitas)

                                <span class="rounded bg-slate-800 px-2 py-1 text-xs">

                                    {{ $fasilitas->nama_fasilitas }}

                                </span>

                            @empty

                                <span class="text-xs italic text-gray-500">

                                    Tidak ada fasilitas

                                </span>

                            @endforelse

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div>

                        <p class="mb-4 text-lg font-bold text-red-500">

                            Rp {{ number_format($armada->harga_sewa ?? 0, 0, ',', '.') }}

                        </p>

                        @if($armada?->id_armada)

                            <a
                                href="{{ route('reservasi.create', ['armada' => $armada->id_armada]) }}"
                                class="block rounded-lg bg-red-600 px-4 py-2 text-center font-semibold transition hover:bg-red-700"
                            >
                                Sewa Sekarang
                            </a>

                        @else

                            <button
                                disabled
                                class="block w-full cursor-not-allowed rounded-lg bg-slate-700 px-4 py-2 text-center font-semibold text-gray-400"
                            >
                                Armada Belum Tersedia
                            </button>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="rounded-2xl border border-dashed border-slate-700 py-16 text-center">

            <h4 class="mb-2 text-xl font-semibold text-gray-300">

                Armada Belum Tersedia

            </h4>

            <p class="text-gray-500">

                Saat ini belum ada armada yang ditambahkan ke sistem.

            </p>

        </div>

    @endif

</section>

{{-- CTA SECTION --}}
<section class="bg-slate-900 py-20 text-center">

    <h3 class="mb-6 text-3xl font-bold">

        Siap Memulai Perjalanan Anda?

    </h3>

    <p class="mb-8 text-gray-400">

        Pilih armada dan tentukan jadwal sesuai kebutuhan Anda.

    </p>

    @if(isset($armadas) && $armadas->count())

        <a
            href="{{ route('reservasi.create', ['armada' => $armadas->first()->id_armada]) }}"
            class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-semibold transition hover:bg-red-700"
        >
            Mulai Booking
        </a>

    @else

        <button
            disabled
            class="cursor-not-allowed rounded-lg bg-slate-700 px-6 py-3 font-semibold text-gray-400"
        >
            Armada Belum Tersedia
        </button>

    @endif

</section>

{{-- TESTIMONI --}}
<section class="py-16 text-center">

    <h3 class="mb-8 text-3xl font-bold">

        Testimoni

    </h3>

    <div class="mx-auto max-w-3xl space-y-4 text-gray-400">

        <p>
            “Pelayanan cepat dan armada sangat nyaman.” — Andi
        </p>

        <p>
            “Driver ramah, perjalanan aman.” — Sinta
        </p>

    </div>

</section>

{{-- FOOTER --}}
<footer class="bg-black py-8 text-center text-sm text-gray-500">

    <p>

        &copy; {{ date('Y') }}
        Wanderlusth Cantigi Tour

    </p>

</footer>

</body>
</html>