@extends('admin.layouts.app')

@section('title', 'Manajemen Pembayaran')
@section('page-title', 'Manajemen Pembayaran')

@section('page-description', 'Kelola transaksi pembayaran reservasi pelanggan')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-white">
                Data Pembayaran
            </h2>

            <p class="mt-1 text-sm text-slate-400">
                Monitoring pembayaran reservasi pelanggan
            </p>

        </div>

    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))

        <div class="
            flex items-start gap-3
            rounded-2xl
            border border-emerald-500/20
            bg-emerald-500/10
            px-4 py-3
            text-sm text-emerald-300
        ">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="mt-0.5 h-5 w-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7" />

            </svg>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif

    @if(session('error'))

        <div class="
            flex items-start gap-3
            rounded-2xl
            border border-red-500/20
            bg-red-500/10
            px-4 py-3
            text-sm text-red-300
        ">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="mt-0.5 h-5 w-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />

            </svg>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif

    {{-- TABLE --}}
    <div class="
        overflow-hidden
        rounded-3xl
        border border-slate-200
        bg-white
        shadow-xl
    ">

        @if($reservasis->count())

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    {{-- TABLE HEAD --}}
                    <thead class="
                        bg-slate-100
                        text-left text-xs
                        font-semibold uppercase
                        tracking-wider
                        text-slate-700
                    ">

                        <tr>

                            <th class="px-6 py-4">
                                Reservasi
                            </th>

                            <th class="px-6 py-4">
                                Armada
                            </th>

                            <th class="px-6 py-4">
                                Perjalanan
                            </th>

                            <th class="px-6 py-4">
                                Pembayaran
                            </th>

                            <th class="px-6 py-4 text-center">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-slate-200">

                        @foreach($reservasis as $reservasi)

                            @php
                                $pembayaran = $reservasi->pembayaran;
                            @endphp

                            <tr class="transition hover:bg-slate-50">

                                {{-- RESERVASI --}}
                                <td class="px-6 py-5 align-top">

                                    <div class="space-y-3">

                                        <span class="
                                            inline-flex items-center
                                            rounded-xl
                                            bg-indigo-100
                                            px-3 py-1
                                            text-xs font-bold
                                            text-indigo-700
                                        ">

                                            #RES-{{ str_pad($reservasi->id_reservasi, 4, '0', STR_PAD_LEFT) }}

                                        </span>

                                        <div>

                                            <p class="font-semibold text-slate-900">
                                                {{ $reservasi->pelanggan?->nama ?? '-' }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ $reservasi->pelanggan?->no_hp ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- ARMADA --}}
                                <td class="px-6 py-5 align-top">

                                    <div class="space-y-1">

                                        <p class="font-semibold text-slate-900">
                                            {{ $reservasi->armada?->jenis_kendaraan ?? '-' }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Kapasitas:
                                            {{ $reservasi->armada?->kapasitas ?? '-' }}
                                            Orang
                                        </p>

                                    </div>

                                </td>

                                {{-- PERJALANAN --}}
                                <td class="px-6 py-5 align-top">

                                    <div class="space-y-2">

                                        <div>

                                            <p class="font-semibold text-slate-900">
                                                {{ $reservasi->formatted_tanggal }}
                                            </p>

                                            <p class="text-sm text-slate-500">
                                                {{ $reservasi->formatted_waktu }}
                                            </p>

                                        </div>

                                        <p class="text-xs font-medium text-indigo-600">
                                            {{ $reservasi->tujuan ?? '-' }}
                                        </p>

                                    </div>

                                </td>

                                {{-- PEMBAYARAN --}}
                                <td class="px-6 py-5 align-top">

                                    @if($pembayaran)

                                        <div class="space-y-3">

                                            <div>

                                                <p class="text-xs text-slate-500">
                                                    Total Dibayar
                                                </p>

                                                <p class="mt-1 font-semibold text-emerald-600">
                                                    Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}
                                                </p>

                                            </div>

                                            <div>

                                                <p class="text-xs text-slate-500">
                                                    Sisa Pembayaran
                                                </p>

                                                <p class="mt-1 font-semibold text-red-500">
                                                    Rp {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}
                                                </p>

                                            </div>

                                            <div>

                                                <p class="text-xs text-slate-500">
                                                    Metode
                                                </p>

                                                <p class="mt-1 font-medium text-slate-700">
                                                    {{ $pembayaran->metode_pembayaran ?? '-' }}
                                                </p>

                                            </div>

                                        </div>

                                    @else

                                        <div class="space-y-1">

                                            <p class="font-medium text-slate-700">
                                                Belum ada pembayaran
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Menunggu transaksi pembayaran
                                            </p>

                                        </div>

                                    @endif

                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5 text-center align-top">

                                    @if(!$pembayaran)

                                        <span class="
                                            inline-flex items-center justify-center
                                            rounded-full
                                            bg-slate-100
                                            px-4 py-2
                                            text-xs font-bold
                                            text-slate-700
                                        ">

                                            Belum Bayar

                                        </span>

                                    @elseif($pembayaran->status_pembayaran === 'DP')

                                        <span class="
                                            inline-flex items-center justify-center
                                            rounded-full
                                            bg-yellow-100
                                            px-4 py-2
                                            text-xs font-bold
                                            text-yellow-700
                                        ">

                                            DP

                                        </span>

                                    @else

                                        <span class="
                                            inline-flex items-center justify-center
                                            rounded-full
                                            bg-green-100
                                            px-4 py-2
                                            text-xs font-bold
                                            text-green-700
                                        ">

                                            Lunas

                                        </span>

                                    @endif

                                </td>

                                {{-- AKSI --}}
<td class="px-6 py-5 text-center align-top">

    @if(!$pembayaran)

        {{-- INPUT PEMBAYARAN --}}
        <a
            href="{{ route('admin.pembayaran.create', [
                'reservasi' => $reservasi->id_reservasi
            ]) }}"
            class="
                inline-flex items-center
                rounded-xl
                bg-emerald-600
                px-4 py-2
                text-xs font-semibold
                text-white
                transition
                hover:bg-emerald-700
            "
        >
            Input Pembayaran
        </a>

    @elseif($pembayaran->status_pembayaran === 'DP')

        {{-- EDIT PEMBAYARAN --}}
        <a
            href="{{ route('admin.pembayaran.edit', $pembayaran->id_pembayaran) }}"
            class="
                inline-flex items-center
                rounded-xl
                bg-amber-500
                px-4 py-2
                text-xs font-semibold
                text-white
                transition
                hover:bg-amber-600
            "
        >
            Edit Pembayaran
        </a>

    @else

        {{-- SUDAH LUNAS --}}
        <div class="flex flex-col items-center gap-2">

            <span class="
                inline-flex items-center
                rounded-xl
                bg-emerald-100
                px-4 py-2
                text-xs font-semibold
                text-emerald-700
            ">
                Pembayaran Lunas
            </span>

            {{-- CEK DENDA --}}
            @if(($pembayaran->denda ?? 0) > 0)

                {{-- DENDA SUDAH ADA --}}
                <div class="flex flex-col items-center gap-2">

                    <span class="
                        inline-flex items-center
                        rounded-xl
                        bg-red-100
                        px-4 py-2
                        text-xs font-semibold
                        text-red-700
                    ">
                        Denda:
                        Rp {{ number_format($pembayaran->denda, 0, ',', '.') }}
                    </span>

                    <a
                        href="{{ route(
                            'admin.pembayaran.denda.edit',
                            $pembayaran->id_pembayaran
                        ) }}"
                        class="
                            inline-flex items-center
                            rounded-xl
                            bg-amber-500
                            px-4 py-2
                            text-xs font-semibold
                            text-white
                            transition
                            hover:bg-amber-600
                        "
                    >
                        Edit Denda
                    </a>

                </div>

            @else

                {{-- BELUM ADA DENDA --}}
                <a
                    href="{{ route(
                        'admin.pembayaran.denda.create',
                        $pembayaran->id_pembayaran
                    ) }}"
                    class="
                        inline-flex items-center
                        rounded-xl
                        bg-red-600
                        px-4 py-2
                        text-xs font-semibold
                        text-white
                        transition
                        hover:bg-red-700
                    "
                >
                    Input Denda
                </a>

            @endif

        </div>

    @endif

</td>

                                    
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="
                border-t border-slate-200
                bg-slate-50
                px-6 py-4
            ">

                {{ $reservasis->links() }}

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="px-6 py-24 text-center">

                <div class="
                    mx-auto mb-6
                    flex h-24 w-24 items-center justify-center
                    rounded-full
                    bg-slate-100
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-12 w-12 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 9V7a5 5 0 00-10 0v2M5 9h14l1 11H4L5 9z" />

                    </svg>

                </div>

                <h3 class="text-xl font-bold text-slate-700">
                    Belum Ada Data Pembayaran
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Data pembayaran reservasi akan muncul di halaman ini
                </p>

            </div>

        @endif

    </div>

</div>

@endsection