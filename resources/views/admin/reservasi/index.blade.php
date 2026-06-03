@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')
@section('page-title', 'Manajemen Reservasi')

@section(
    'page-description',
    'Monitoring reservasi dan status pembayaran pelanggan'
)

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-2xl font-bold text-white">
                Data Reservasi
            </h2>

            <p class="text-sm text-slate-400 mt-1">
                Kelola seluruh reservasi pelanggan dan pembayaran
            </p>

        </div>

    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="
            px-4 py-3 rounded-2xl
            border border-green-500/20
            bg-green-500/10
            text-green-300 text-sm
        ">

            {{ session('success') }}

        </div>

    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="
            px-4 py-3 rounded-2xl
            border border-red-500/20
            bg-red-500/10
            text-red-300 text-sm
        ">

            {{ session('error') }}

        </div>

    @endif

    {{-- TABLE --}}
    <div class="
        bg-white rounded-3xl
        border border-slate-200
        shadow-2xl overflow-hidden
    ">

        @if($reservasis->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- TABLE HEAD --}}
                <thead class="
                    bg-slate-100
                    text-slate-700
                    uppercase text-xs
                    tracking-wider
                ">

                    <tr>

                        <th class="px-6 py-5 text-left">
                            Pelanggan
                        </th>

                        <th class="px-6 py-5 text-left">
                            Armada & Tujuan
                        </th>

                        <th class="px-6 py-5 text-left">
                            Jadwal
                        </th>

                        <th class="px-6 py-5 text-center">
                            Status Reservasi
                        </th>

                        <th class="px-6 py-5 text-center">
                            Pembayaran
                        </th>

                        <th class="px-6 py-5 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-slate-200">

                    @foreach($reservasis as $reservasi)

                    <tr class="
                        hover:bg-indigo-50/60
                        transition-all duration-200
                    ">

                        {{-- PELANGGAN --}}
                        <td class="px-6 py-5">

                            <div>

                                <p class="font-semibold text-slate-900">
                                    {{ optional($reservasi->pelanggan)->nama ?? '-' }}
                                </p>

                                <p class="text-xs text-slate-500 mt-1">
                                    {{ optional($reservasi->pelanggan)->no_hp ?? '-' }}
                                </p>

                            </div>

                        </td>

                        {{-- ARMADA --}}
                        <td class="px-6 py-5">

                            <div class="space-y-1">

                                <p class="font-semibold text-slate-900">
                                    {{ optional($reservasi->armada)->jenis_kendaraan ?? '-' }}
                                </p>

                                <p class="text-xs text-indigo-600">
                                    {{ $reservasi->tujuan ?? '-' }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    Kapasitas:
                                    {{ optional($reservasi->armada)->kapasitas ?? '-' }}
                                    Orang
                                </p>

                            </div>

                        </td>

                        {{-- JADWAL --}}
                        <td class="px-6 py-5">

                            <div>

                                <p class="font-semibold text-slate-900">
                                    {{ $reservasi->formatted_tanggal }}
                                </p>

                                <p class="text-sm text-slate-600 mt-1">
                                    {{ $reservasi->formatted_waktu }}
                                </p>

                            </div>

                        </td>

                        {{-- STATUS RESERVASI --}}
                        <td class="px-6 py-5 text-center">

                            <span class="
                                inline-flex items-center
                                px-4 py-2 rounded-full
                                text-xs font-bold
                                {{ $reservasi->status_badge }}
                            ">

                                {{ $reservasi->status_label }}

                            </span>

                        </td>

                        {{-- STATUS PEMBAYARAN --}}
                        <td class="px-6 py-5 text-center">

                            <span class="
                                inline-flex items-center
                                px-4 py-2 rounded-full
                                text-xs font-bold
                                {{ $reservasi->payment_badge }}
                            ">

                                {{ $reservasi->payment_status }}

                            </span>

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="
                                flex items-center
                                justify-center gap-2
                            ">

                                {{-- DETAIL --}}
                                <a href="{{ route('admin.reservasi.show', $reservasi) }}"
                                   class="
                                        inline-flex items-center
                                        px-4 py-2 rounded-xl
                                        bg-slate-900
                                        text-white text-xs font-medium
                                        hover:bg-slate-800
                                        transition
                                   ">

                                    Detail

                                </a>

                                {{-- PEMBAYARAN --}}
                                @if(
                                    !$reservasi->pembayaran
                                    && !$reservasi->isCancelled()
                                )

                                <a href="{{ route('admin.pembayaran.create', $reservasi) }}"
                                   class="
                                        inline-flex items-center
                                        px-4 py-2 rounded-xl
                                        bg-indigo-600
                                        text-white text-xs font-medium
                                        hover:bg-indigo-700
                                        transition
                                   ">

                                    Bayar

                                </a>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if(method_exists($reservasis, 'links'))

        <div class="
            px-6 py-4
            border-t border-slate-200
            bg-slate-50
        ">

            {{ $reservasis->links() }}

        </div>

        @endif

        @else

        {{-- EMPTY STATE --}}
        <div class="py-24 text-center">

            <div class="
                w-24 h-24 mx-auto
                rounded-full bg-slate-100
                flex items-center justify-center
                mb-6
            ">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-12 h-12 text-slate-400"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

                </svg>

            </div>

            <h3 class="text-xl font-bold text-slate-700">
                Belum Ada Reservasi
            </h3>

            <p class="text-sm text-slate-500 mt-2">
                Data reservasi pelanggan akan muncul di halaman ini
            </p>

        </div>

        @endif

    </div>

</div>

@endsection