@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan Bulanan')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-bold text-white">Laporan Bulanan</h2>
        <p class="text-sm text-blue-300">
            Preview data reservasi bulan 
{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}
        </p>
    </div>

    {{-- FILTER + ACTION --}}
    <div class="flex flex-wrap gap-3 items-center justify-between">

        <form method="GET" class="flex gap-3">

            {{-- BULAN --}}
            <select name="bulan" class="px-3 py-2 pr-8 rounded-lg bg-white text-black text-sm">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        
            {{-- TAHUN --}}
            <select name="tahun" class="px-3 py-2 pr-8 rounded-lg bg-white text-black text-sm">
                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        
            <button class="bg-indigo-600 px-4 py-2 rounded-lg text-white text-sm hover:bg-indigo-700 transition">
                Filter
            </button>
        
        </form>

        <a href="{{ route('admin.laporan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
           target="_blank"
           class="bg-red-600 px-4 py-2 rounded-lg text-white text-sm hover:bg-red-700 transition">
           Export PDF
        </a>

    </div>

    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl p-4 shadow border">
            <p class="text-sm text-slate-500">Total Reservasi</p>
            <p class="text-xl font-bold text-slate-800">
                {{ $totalReservasi }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-4 shadow border">
            <p class="text-sm text-slate-500">Dikonfirmasi</p>
            <p class="text-xl font-bold text-green-600">
                {{ $statusSummary['Dikonfirmasi'] ?? 0 }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-4 shadow border">
            <p class="text-sm text-slate-500">Dibatalkan</p>
            <p class="text-xl font-bold text-red-600">
                {{ $statusSummary['Dibatalkan'] ?? 0 }}
            </p>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        @if($reservasis->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- HEAD --}}
                <thead class="bg-slate-100 text-slate-700 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-5 py-4 text-left">Pelanggan</th>
                        <th class="px-5 py-4 text-left">Armada</th>
                        <th class="px-5 py-4 text-left">Perjalanan</th>
                        <th class="px-5 py-4 text-center">Status</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y">

                    @foreach ($reservasis as $reservasi)

                    <tr class="hover:bg-indigo-50 transition">

                        {{-- Pelanggan --}}
                        <td class="px-5 py-4">
                            <p class="font-semibold text-slate-900">
                                {{ optional($reservasi->pelanggan)->nama ?? '-' }}
                            </p>
                            <p class="text-xs text-indigo-500">
                                {{ optional($reservasi->pelanggan)->no_hp ?? '-' }}
                            </p>
                        </td>

                        {{-- Armada --}}
                        <td class="px-5 py-4">
                            <p class="font-medium text-slate-800">
                                {{ optional($reservasi->armada)->jenis_kendaraan ?? '-' }}
                            </p>
                            <p class="text-xs text-indigo-500">
                                Kapasitas: {{ optional($reservasi->armada)->kapasitas ?? '-' }}
                            </p>
                        </td>

                        {{-- Perjalanan --}}
                        <td class="px-5 py-4">
                            <p class="font-semibold text-slate-900">
                                {{ $reservasi->formatted_tanggal }}
                            </p>
                            <p class="text-sm text-slate-700">
                                {{ $reservasi->formatted_waktu }}
                            </p>
                            <p class="text-xs text-indigo-500 mt-1">
                                {{ $reservasi->tujuan ?? '-' }}
                            </p>
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4 text-center">
                            <span
                                @class([
                                    'px-3 py-1 text-xs font-semibold rounded-full',

                                    'bg-yellow-100 text-yellow-700' => $reservasi->status === 'pending',
                                    'bg-green-100 text-green-700' => $reservasi->status === 'dikonfirmasi',
                                    'bg-red-100 text-red-700' => $reservasi->status === 'dibatalkan',

                                    'bg-gray-100 text-gray-700' => true,
                                ])
                            >
                                {{ $reservasi->status_label }}
                            </span>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="text-center py-16">
            <p class="text-slate-600 text-sm">Tidak ada data pada periode ini</p>
        </div>

        @endif

    </div>

</div>

@endsection