@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')
@section('page-title', 'Manajemen Reservasi')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-bold text-white">Data Reservasi</h2>
        <p class="text-sm text-blue-300">Kelola semua pemesanan pelanggan</p>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-green-500/10 border border-green-500/30 text-green-300 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        @if($reservasis->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- TABLE HEAD --}}
                <thead class="bg-slate-100 text-slate-700 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-5 py-4 text-left">Pelanggan</th>
                        <th class="px-5 py-4 text-left">Armada</th>
                        <th class="px-5 py-4 text-left">Perjalanan</th>
                        <th class="px-5 py-4 text-center">Status</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                

                {{-- TABLE BODY --}}
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
                        
                                    // status mapping
                                    'bg-yellow-100 text-yellow-700' => $reservasi->status === 'pending',
                                    'bg-green-100 text-green-700' => $reservasi->status === 'dikonfirmasi',
                                    'bg-red-100 text-red-700' => $reservasi->status === 'dibatalkan',
                        
                                    // fallback
                                    'bg-gray-100 text-gray-700' => !in_array($reservasi->status, ['pending','dikonfirmasi','dibatalkan']),
                                ])
                            >
                                {{ $reservasi->status_label }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-4 text-center">
                            <a href="{{ route('admin.reservasi.show', $reservasi) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-600 text-white text-xs rounded-lg hover:bg-indigo-700 transition">
                                Detail → 
                            </a>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>


        </div>

        @else

        {{-- EMPTY STATE --}}
        <div class="text-center py-16">
            <p class="text-slate-600 text-sm">Belum ada data reservasi</p>
        </div>

        @endif

    </div>

</div>
@endsection