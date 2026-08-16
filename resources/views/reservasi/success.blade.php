<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reservasi Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center px-4">

<div class="bg-slate-900 max-w-xl w-full rounded-2xl shadow-lg p-8 border border-white/10">

    {{-- SUCCESS ICON --}}
    <div class="flex justify-center mb-6">
        <div class="bg-green-500/20 text-green-400 rounded-full p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>
        </div>
    </div>

    {{-- TITLE --}}
    <h1 class="text-2xl font-bold text-center mb-2">
        Reservasi Berhasil
    </h1>

    <p class="text-center text-gray-400 mb-6 text-sm">
        Data reservasi Anda telah kami terima. Silakan lanjutkan konfirmasi ke admin.
    </p>

    {{-- DETAIL --}}
    <div class="bg-slate-800 rounded-xl p-5 mb-6 text-sm space-y-3">

        {{-- CUSTOMER --}}
        <div>
            <p class="text-gray-400 text-xs mb-1">Data Pelanggan</p>
            <p><span class="font-semibold">Nama:</span> {{ $reservasi->pelanggan->nama }}</p>
            <p><span class="font-semibold">No HP:</span> {{ $reservasi->pelanggan->no_hp }}</p>
        </div>

        <hr class="border-white/10">

        {{-- ARMADA --}}
        <div>
            <p class="text-gray-400 text-xs mb-1">Detail Armada</p>

            <p><span class="font-semibold">Armada:</span>
                {{ $reservasi->armada->jenis_kendaraan ?? '-' }}</p>

            <p><span class="font-semibold">Plat:</span>
                {{ $reservasi->armada->plat_nomor ?? '-' }}</p>

            <p><span class="font-semibold">Kapasitas:</span>
                {{ $reservasi->armada->kapasitas ?? '-' }} Orang</p>
        </div>

        <hr class="border-white/10">

        {{-- BOOKING --}}
        <div>
            <p class="text-gray-400 text-xs mb-1">Detail Perjalanan</p>

            <p><span class="font-semibold">Tanggal:</span>
                {{ $reservasi->tanggal_reservasi->format('d M Y') }}</p>

            <p><span class="font-semibold">Waktu:</span>
                {{ $reservasi->waktu->format('H:i') }} WIB</p>

            <p><span class="font-semibold">Tujuan:</span>
                {{ $reservasi->tujuan }}</p>

            <p><span class="font-semibold">Penumpang:</span>
                {{ $reservasi->jumlah_penumpang }} Orang</p>
        </div>

        <hr class="border-white/10">

        {{-- PRICE --}}
        <div>
            <p class="text-red-500 font-bold">
                Rp {{ number_format($reservasi->armada->harga_sewa ?? 0, 0, ',', '.') }}
            </p>

            <p class="text-yellow-400 text-sm mt-1">
                Status: {{ ucfirst($reservasi->status_reservasi) }}
            </p>
        </div>

    </div>

    {{-- WHATSAPP --}}
    @php
        $adminPhone = '6285356969541';

        $message = urlencode(
            "Halo Admin Wanderlusth,\n\n" .
            "Saya telah melakukan reservasi:\n\n" .
            "Nama: {$reservasi->pelanggan->nama}\n" .
            "No HP: {$reservasi->pelanggan->no_hp}\n" .
            "Armada: " . ($reservasi->armada->jenis_kendaraan ?? '-') . "\n" .
            "Tanggal: {$reservasi->tanggal}\n" .
            "Waktu: {$reservasi->waktu}\n" .
            "Tujuan: {$reservasi->tujuan}\n\n" .
            "Mohon informasi pembayaran."
        );
    @endphp

    <a href="https://wa.me/{{ $adminPhone }}?text={{ $message }}"
       target="_blank"
       class="block w-full text-center bg-green-500 hover:bg-green-600
              text-white font-semibold py-3 rounded-lg transition mb-4">
        Konfirmasi via WhatsApp
    </a>

    {{-- BACK --}}
    <div class="text-center">
        <a href="{{ url('/') }}"
           class="text-sm text-gray-400 hover:text-white">
            ← Kembali ke Beranda
        </a>
    </div>

</div>

</body>
</html>