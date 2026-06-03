@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('page-description', 'Ringkasan aktivitas sistem reservasi bus pariwisata')

@section('content')

<div class="space-y-8">

    <!-- WELCOME -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold tracking-tight">
                Selamat Datang, {{ auth()->user()->name }}
            </h1>

            <p class="text-slate-400 mt-2">
                Pantau reservasi, pembayaran, dan aktivitas sistem secara realtime.
            </p>
        </div>

        <!-- QUICK ACTION -->
        <div class="flex flex-wrap gap-3">

            <a href="{{ route('admin.armada.create') }}"
                class="
                    inline-flex items-center gap-2
                    px-5 py-3 rounded-xl
                    bg-indigo-600 hover:bg-indigo-700
                    transition-all duration-200
                    shadow-lg shadow-indigo-600/20
                ">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>

                Tambah Armada

            </a>

            {{-- <a href="{{ route('admin.reservasi.create') }}"
                class="
                    inline-flex items-center gap-2
                    px-5 py-3 rounded-xl
                    bg-pink-600 hover:bg-pink-700
                    transition-all duration-200
                    shadow-lg shadow-pink-600/20
                "> --}}

                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>

                Input Reservasi

            </a> --}}

        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- TOTAL ARMADA -->
        <div class="
            relative overflow-hidden
            bg-white/5 border border-white/10
            rounded-2xl p-6
            backdrop-blur-xl
        ">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Armada
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $totalArmada }}
                    </h2>

                    <p class="text-sm text-emerald-400 mt-3">
                        Armada aktif tersedia
                    </p>

                </div>

                <div class="
                    w-14 h-14 rounded-2xl
                    bg-indigo-500/20
                    flex items-center justify-center
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-indigo-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 16V8m8 8V8M4 20h16" />
                    </svg>

                </div>

            </div>

        </div>

        <!-- TOTAL RESERVASI -->
        <div class="
            relative overflow-hidden
            bg-white/5 border border-white/10
            rounded-2xl p-6
            backdrop-blur-xl
        ">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Reservasi
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $totalReservasi }}
                    </h2>

                    <p class="text-sm text-pink-400 mt-3">
                        Hari ini: {{ $todayReservasi ?? 0 }}
                    </p>

                </div>

                <div class="
                    w-14 h-14 rounded-2xl
                    bg-pink-500/20
                    flex items-center justify-center
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-pink-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>

                </div>

            </div>

        </div>

        <!-- DIKONFIRMASI -->
        <div class="
            relative overflow-hidden
            bg-white/5 border border-white/10
            rounded-2xl p-6
            backdrop-blur-xl
        ">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Dikonfirmasi
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $confirmedReservasi }}
                    </h2>

                    <p class="text-sm text-emerald-400 mt-3">
                        Reservasi berhasil
                    </p>

                </div>

                <div class="
                    w-14 h-14 rounded-2xl
                    bg-emerald-500/20
                    flex items-center justify-center
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-emerald-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                </div>

            </div>

        </div>

        <!-- PENDING -->
        <div class="
            relative overflow-hidden
            bg-white/5 border border-white/10
            rounded-2xl p-6
            backdrop-blur-xl
        ">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Pending
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $pendingReservasi }}
                    </h2>

                    <p class="text-sm text-yellow-400 mt-3">
                        Menunggu konfirmasi
                    </p>

                </div>

                <div class="
                    w-14 h-14 rounded-2xl
                    bg-yellow-500/20
                    flex items-center justify-center
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-yellow-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4m0 4h.01" />
                    </svg>

                </div>

            </div>

        </div>

    </div>

    <!-- CHART -->
    <div class="
        bg-white/5 border border-white/10
        rounded-2xl p-6 backdrop-blur-xl
    ">

        <div class="flex items-center justify-between mb-8">

            <div>

                <h3 class="text-xl font-semibold">
                    Statistik Reservasi
                </h3>

                <p class="text-sm text-slate-400 mt-1">
                    Grafik jumlah reservasi bulanan
                </p>

            </div>

        </div>

        <div class="h-[350px]">

            <canvas id="reservasiChart"></canvas>

        </div>

    </div>

    <!-- RECENT RESERVASI -->
    <div class="
        bg-white/5 border border-white/10
        rounded-2xl overflow-hidden
        backdrop-blur-xl
    ">

        <!-- HEADER -->
        <div class="
            px-6 py-5 border-b border-white/10
            flex items-center justify-between
        ">

            <div>

                <h3 class="text-xl font-semibold">
                    Reservasi Terbaru
                </h3>

                <p class="text-sm text-slate-400 mt-1">
                    Aktivitas reservasi terbaru pelanggan
                </p>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-white/5 text-slate-400">

                    <tr>

                        <th class="px-6 py-4 text-left font-medium">
                            Pelanggan
                        </th>

                        <th class="px-6 py-4 text-left font-medium">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left font-medium">
                            Armada
                        </th>

                        <th class="px-6 py-4 text-left font-medium">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentReservasi as $item)

                        <tr class="border-t border-white/5 hover:bg-white/[0.03] transition">

                            <!-- NAMA -->
                            <td class="px-6 py-5">

                                <div>

                                    <p class="font-medium text-white">
                                        {{ $item->pelanggan->nama ?? '-' }}
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ $item->tujuan }}
                                    </p>

                                </div>

                            </td>

                            <!-- TANGGAL -->
                            <td class="px-6 py-5 text-slate-300">

                                {{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d M Y') }}

                            </td>

                            <!-- ARMADA -->
                            <td class="px-6 py-5">

                                <div>

                                    <p class="font-medium">
                                        {{ $item->armada->jenis_kendaraan ?? '-' }}
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Kapasitas:
                                        {{ $item->armada->kapasitas ?? '-' }}
                                    </p>

                                </div>

                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-5">

                                <span class="
                                    inline-flex items-center
                                    px-3 py-1 rounded-full
                                    text-xs font-medium

                                    {{ $item->status_reservasi === 'Pending'
                                        ? 'bg-yellow-500/15 text-yellow-400 border border-yellow-500/20'
                                        : '' }}

                                    {{ $item->status_reservasi === 'Dikonfirmasi'
                                        ? 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/20'
                                        : '' }}

                                    {{ $item->status_reservasi === 'Dibatalkan'
                                        ? 'bg-red-500/15 text-red-400 border border-red-500/20'
                                        : '' }}
                                ">

                                    {{ $item->status_reservasi }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="py-12 text-center text-slate-400">

                                Belum ada data reservasi

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document
        .getElementById('reservasiChart')
        .getContext('2d');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: @json($chartLabels),

            datasets: [{

                label: 'Jumlah Reservasi',

                data: @json($chartData),

                backgroundColor: 'rgba(99,102,241,0.5)',

                borderColor: 'rgba(99,102,241,1)',

                borderWidth: 1,

                borderRadius: 10,

                hoverBackgroundColor: 'rgba(99,102,241,0.7)',

            }]
        },

        options: {

            maintainAspectRatio: false,

            responsive: true,

            plugins: {

                legend: {

                    labels: {

                        color: '#cbd5e1',
                        font: {
                            size: 13
                        }

                    }

                }

            },

            scales: {

                x: {

                    ticks: {

                        color: '#94a3b8'

                    },

                    grid: {

                        color: 'rgba(255,255,255,0.03)'

                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        color: '#94a3b8',
                        stepSize: 1

                    },

                    grid: {

                        color: 'rgba(255,255,255,0.03)'

                    }

                }

            }

        }

    });

});

</script>

@endpush

@endsection