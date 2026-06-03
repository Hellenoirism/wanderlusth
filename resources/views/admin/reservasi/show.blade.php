@extends('admin.layouts.app')

@section('title', 'Detail Reservasi')
@section('page-title', 'Detail Reservasi')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white">Detail Reservasi</h2>
            <p class="text-sm text-blue-300">ID: #{{ $reservasi->id_reservasi }}</p>
        </div>

        <a href="{{ route('admin.reservasi.index') }}"
           class="px-4 py-2 text-sm bg-white/10 text-white rounded-lg hover:bg-white/20 transition">
            ← Kembali
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-green-500/10 border border-green-500/30 text-green-300 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- STATUS + ACTION --}}
    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <p class="text-xs text-blue-300 mb-1">Status Reservasi</p>
            <span class="px-4 py-1.5 text-xs font-semibold rounded-full {{ $reservasi->status_badge }}">
                {{ $reservasi->status_label }}
            </span>
        </div>

        

    </div>

    {{-- GRID --}}
    <div class="grid md:grid-cols-2 gap-6">

        {{-- PELANGGAN --}}
        <div class="bg-white rounded-2xl p-6 shadow border">
            <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wide">
                Informasi Pelanggan
            </h3>

            <div class="space-y-4 text-sm">

                <div>
                    <p class="text-indigo-500 font-medium">Nama</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ optional($reservasi->pelanggan)->nama ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-indigo-500 font-medium">No HP</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ optional($reservasi->pelanggan)->no_hp ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- ARMADA --}}
        <div class="bg-white rounded-2xl p-6 shadow border">
            <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wide">
                Informasi Armada
            </h3>

            <div class="space-y-4 text-sm">

                <div>
                    <p class="text-indigo-500 font-medium">Jenis Kendaraan</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ optional($reservasi->armada)->jenis_kendaraan ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-indigo-500 font-medium">Kapasitas</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ optional($reservasi->armada)->kapasitas ?? '-' }} Seat
                    </p>
                </div>

            </div>
        </div>

        {{-- PERJALANAN --}}
        <div class="bg-white rounded-2xl p-6 shadow border md:col-span-2">
            <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wide">
                Detail Perjalanan
            </h3>

            <div class="grid md:grid-cols-3 gap-5 text-sm">

                <div>
                    <p class="text-indigo-500 font-medium">Tanggal</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ $reservasi->tanggal_reservasi 
                            ? \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') 
                            : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-indigo-500 font-medium">Waktu</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ $reservasi->waktu 
                            ? \Carbon\Carbon::parse($reservasi->waktu)->format('H:i') . ' WIB'
                            : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-indigo-500 font-medium">Penumpang</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ $reservasi->jumlah_penumpang ?? '-' }} Orang
                    </p>
                </div>

                <div class="md:col-span-3">
                    <p class="text-indigo-500 font-medium">Tujuan</p>
                    <p class="text-slate-900 font-semibold text-base">
                        {{ $reservasi->tujuan ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection