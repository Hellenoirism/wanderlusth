<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Wanderlusth Cantigi Tour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white scroll-smooth">

{{-- NAVBAR --}}
<header class="fixed top-0 w-full bg-slate-900/80 backdrop-blur z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-red-500">Wanderlusth</h1>

        <a href="#armada"
           class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-semibold">
            Booking Sekarang
        </a>
    </div>
</header>

{{-- HERO --}}
<section class="h-screen flex items-center justify-center text-center px-6">
    <div class="max-w-3xl">
        <h2 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
            Sewa Bus Nyaman & Aman<br>
            <span class="text-red-500">Untuk Semua Perjalanan Anda</span>
        </h2>

        <p class="text-gray-400 mb-8">
            Armada terawat, driver profesional, dan sistem booking fleksibel sesuai kebutuhan Anda.
        </p>

        <div class="flex justify-center gap-4">
            <a href="#armada"
               class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold">
                Booking Sekarang
            </a>

            <a href="#armada"
               class="border border-gray-600 px-6 py-3 rounded-lg">
                Lihat Armada
            </a>
        </div>
    </div>
</section>

{{-- TRUST --}}
<section class="py-10 text-center border-t border-white/10">
    <p class="text-gray-400 text-sm">
        Dipercaya oleh berbagai perusahaan & instansi
    </p>
</section>

{{-- ARMADA --}}
<section id="armada" class="py-16 max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center mb-10">Armada Pilihan</h3>

    @if($armadas->count())
        <div class="grid md:grid-cols-3 gap-8">

            @foreach ($armadas as $armada)
            <div class="bg-slate-900 rounded-2xl p-6 hover:scale-[1.03] transition duration-300 flex flex-col justify-between">

                <div>
                    <h4 class="text-xl font-bold mb-2">
                        {{ $armada->jenis_kendaraan }}
                    </h4>

                    <p class="text-sm text-gray-400 mb-2">
                        Kapasitas: {{ $armada->kapasitas }} Orang
                    </p>

                    {{-- FASILITAS --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        @forelse ($armada->fasilitas as $fasilitas)
                            <span class="text-xs bg-slate-800 px-2 py-1 rounded">
                                {{ $fasilitas->nama_fasilitas }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-500 italic">
                                Tidak ada fasilitas
                            </span>
                        @endforelse
                    </div>
                </div>

                {{-- FOOTER --}}
                <div>
                    <p class="text-red-500 font-bold text-lg mb-4">
                        Rp {{ number_format($armada->harga_sewa,0,',','.') }}
                    </p>

                    <a href="{{ route('reservasi.create', ['armada' => $armada->id_armada]) }}"
                       class="block text-center bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg font-semibold">
                        Sewa Sekarang
                    </a>
                </div>

            </div>
            @endforeach

        </div>
    @else
        <p class="text-center text-gray-500">
            Belum ada armada tersedia
        </p>
    @endif
</section>

{{-- CTA SECTION --}}
<section class="py-20 text-center bg-slate-900">
    <h3 class="text-3xl font-bold mb-6">
        Siap Memulai Perjalanan Anda?
    </h3>

    <p class="text-gray-400 mb-8">
        Pilih armada dan tentukan jadwal sesuai kebutuhan Anda.
    </p>

    <a href="{{ route('reservasi.create', ['armada' => $armada->id_armada]) }}"
        class="bg-red-600 px-4 py-2 rounded-lg">
        Mulai Booking
    </a>
</section>

{{-- TESTIMONI --}}
<section class="py-16 text-center">
    <h3 class="text-3xl font-bold mb-8">Testimoni</h3>

    <div class="max-w-3xl mx-auto space-y-4 text-gray-400">
        <p>“Pelayanan cepat dan armada sangat nyaman.” — Andi</p>
        <p>“Driver ramah, perjalanan aman.” — Sinta</p>
    </div>
</section>

{{-- FOOTER --}}
<footer class="bg-black py-8 text-center text-gray-500 text-sm">
    <p>&copy; {{ date('Y') }} Wanderlusth Cantigi Tour</p>
</footer>

</body>
</html>