@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan Bulanan')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>
            <div class="flex items-center gap-2">

                <span
                    class="h-2 w-2 rounded-full bg-indigo-400 shadow-[0_0_10px_rgba(129,140,248,0.7)]"
                ></span>

                <span
                    class="text-xs font-semibold uppercase tracking-[0.18em] text-indigo-300"
                >
                    Financial Report
                </span>

            </div>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-white">
                Laporan Bulanan
            </h2>

            <p class="mt-1 text-sm text-slate-400">
                Ringkasan operasional dan keuangan periode
                <span class="font-medium text-slate-300">
                    {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                    {{ $tahun }}
                </span>
            </p>
        </div>

        {{-- EXPORT PDF --}}
        <a
            href="{{ route('admin.laporan.pdf', [
                'bulan' => $bulan,
                'tahun' => $tahun
            ]) }}"
            target="_blank"
            class="
                inline-flex
                items-center
                justify-center
                gap-2
                rounded-xl
                border
                border-red-500/20
                bg-red-500/10
                px-4
                py-2.5
                text-sm
                font-semibold
                text-red-300
                transition
                hover:border-red-500/30
                hover:bg-red-500/20
                hover:text-red-200
            "
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 3v12m0 0l4-4m-4 4l-4-4"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 21h14a2 2 0 002-2v-2M3 17v2a2 2 0 002 2"
                />
            </svg>

            Export PDF

        </a>

    </div>


    {{-- =========================================================
        FILTER
    ========================================================== --}}
    <div
        class="
            rounded-2xl
            border
            border-white/[0.08]
            bg-[#0b1120]/80
            p-4
            shadow-xl
            shadow-black/10
            backdrop-blur-xl
        "
    >

        <form
            method="GET"
            class="flex flex-col gap-3 sm:flex-row sm:items-end"
        >

            {{-- BULAN --}}
            <div class="w-full sm:w-48">

                <label
                    for="bulan"
                    class="
                        mb-2
                        block
                        text-[11px]
                        font-semibold
                        uppercase
                        tracking-[0.14em]
                        text-slate-500
                    "
                >
                    Bulan
                </label>

                <select
                    id="bulan"
                    name="bulan"
                    class="
                        w-full
                        rounded-xl
                        border
                        border-slate-700/80
                        bg-slate-900/70
                        px-3
                        py-2.5
                        text-sm
                        text-slate-200
                        outline-none
                        transition
                        focus:border-indigo-500
                        focus:ring-4
                        focus:ring-indigo-500/10
                    "
                >

                    @for ($i = 1; $i <= 12; $i++)

                        <option
                            value="{{ $i }}"
                            @selected($bulan == $i)
                        >
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>

                    @endfor

                </select>

            </div>


            {{-- TAHUN --}}
            <div class="w-full sm:w-40">

                <label
                    for="tahun"
                    class="
                        mb-2
                        block
                        text-[11px]
                        font-semibold
                        uppercase
                        tracking-[0.14em]
                        text-slate-500
                    "
                >
                    Tahun
                </label>

                <select
                    id="tahun"
                    name="tahun"
                    class="
                        w-full
                        rounded-xl
                        border
                        border-slate-700/80
                        bg-slate-900/70
                        px-3
                        py-2.5
                        text-sm
                        text-slate-200
                        outline-none
                        transition
                        focus:border-indigo-500
                        focus:ring-4
                        focus:ring-indigo-500/10
                    "
                >

                    @for ($y = now()->year; $y >= now()->year - 5; $y--)

                        <option
                            value="{{ $y }}"
                            @selected($tahun == $y)
                        >
                            {{ $y }}
                        </option>

                    @endfor

                </select>

            </div>


            {{-- BUTTON FILTER --}}
            <button
                type="submit"
                class="
                    inline-flex
                    h-[42px]
                    items-center
                    justify-center
                    gap-2
                    rounded-xl
                    bg-indigo-600
                    px-5
                    text-sm
                    font-semibold
                    text-white
                    shadow-lg
                    shadow-indigo-600/20
                    transition
                    hover:bg-indigo-500
                    hover:shadow-indigo-600/30
                    focus:outline-none
                    focus:ring-4
                    focus:ring-indigo-500/20
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 4h18M6 10h12M10 16h4M12 20v-4"
                    />
                </svg>

                Filter

            </button>

        </form>

    </div>


    {{-- =========================================================
        SUMMARY CARDS
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL RESERVASI --}}
        <div
            class="
                relative
                overflow-hidden
                rounded-2xl
                border
                border-white/[0.08]
                bg-[#0b1120]
                p-5
                shadow-xl
                shadow-black/10
            "
        >

            <div
                class="
                    absolute
                    -right-8
                    -top-8
                    h-24
                    w-24
                    rounded-full
                    bg-indigo-500/10
                    blur-2xl
                "
            ></div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-medium text-slate-500">
                        Total Reservasi
                    </p>

                    <div
                        class="
                            flex
                            h-9
                            w-9
                            items-center
                            justify-center
                            rounded-xl
                            bg-indigo-500/10
                            text-indigo-400
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-4 text-3xl font-bold text-white">
                    {{ $totalReservasi }}
                </p>

                <p class="mt-1 text-[11px] text-slate-500">
                    Reservasi pada periode ini
                </p>

            </div>

        </div>


        {{-- TOTAL PEMASUKAN --}}
        <div
            class="
                relative
                overflow-hidden
                rounded-2xl
                border
                border-white/[0.08]
                bg-[#0b1120]
                p-5
                shadow-xl
                shadow-black/10
            "
        >

            <div
                class="
                    absolute
                    -right-8
                    -top-8
                    h-24
                    w-24
                    rounded-full
                    bg-emerald-500/10
                    blur-2xl
                "
            ></div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-medium text-slate-500">
                        Total Pemasukan
                    </p>

                    <div
                        class="
                            flex
                            h-9
                            w-9
                            items-center
                            justify-center
                            rounded-xl
                            bg-emerald-500/10
                            text-emerald-400
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6v12m4-9.5c0-1.38-1.79-2.5-4-2.5S8 7.12 8 8.5 9.79 11 12 11s4 1.12 4 2.5S14.21 16 12 16s-4-1.12-4-2.5"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-4 text-xl font-bold text-emerald-400">
                    Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
                </p>

                <p class="mt-2 text-[11px] text-slate-500">
                    Total pembayaran diterima
                </p>

            </div>

        </div>


        {{-- LUNAS --}}
        <div
            class="
                relative
                overflow-hidden
                rounded-2xl
                border
                border-white/[0.08]
                bg-[#0b1120]
                p-5
                shadow-xl
                shadow-black/10
            "
        >

            <div
                class="
                    absolute
                    -right-8
                    -top-8
                    h-24
                    w-24
                    rounded-full
                    bg-blue-500/10
                    blur-2xl
                "
            ></div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-medium text-slate-500">
                        Pembayaran Lunas
                    </p>

                    <div
                        class="
                            flex
                            h-9
                            w-9
                            items-center
                            justify-center
                            rounded-xl
                            bg-blue-500/10
                            text-blue-400
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-4 text-3xl font-bold text-white">
                    {{ $totalLunas }}
                </p>

                <p class="mt-1 text-[11px] text-slate-500">
                    Transaksi telah lunas
                </p>

            </div>

        </div>


        {{-- DP --}}
        <div
            class="
                relative
                overflow-hidden
                rounded-2xl
                border
                border-white/[0.08]
                bg-[#0b1120]
                p-5
                shadow-xl
                shadow-black/10
            "
        >

            <div
                class="
                    absolute
                    -right-8
                    -top-8
                    h-24
                    w-24
                    rounded-full
                    bg-amber-500/10
                    blur-2xl
                "
            ></div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-medium text-slate-500">
                        Pembayaran DP
                    </p>

                    <div
                        class="
                            flex
                            h-9
                            w-9
                            items-center
                            justify-center
                            rounded-xl
                            bg-amber-500/10
                            text-amber-400
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 8v4l3 2"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-4 text-3xl font-bold text-white">
                    {{ $totalDP }}
                </p>

                <p class="mt-1 text-[11px] text-slate-500">
                    Transaksi dengan pembayaran DP
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        ARMADA TERLARIS
    ========================================================== --}}
    @if($armadaTerlaris)

        <div
            class="
                relative
                overflow-hidden
                rounded-2xl
                border
                border-white/[0.08]
                bg-[#0b1120]
                p-6
                shadow-xl
                shadow-black/10
            "
        >

            <div
                class="
                    absolute
                    -right-16
                    -top-16
                    h-40
                    w-40
                    rounded-full
                    bg-purple-500/10
                    blur-3xl
                "
            ></div>

            <div
                class="
                    relative
                    flex
                    flex-col
                    gap-5
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                <div>

                    <div class="flex items-center gap-2">

                        <span
                            class="
                                flex
                                h-8
                                w-8
                                items-center
                                justify-center
                                rounded-lg
                                bg-purple-500/10
                                text-purple-400
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 13h18M5 13l1-5h12l1 5M5 13v5m14-5v5M7 18h2m6 0h2"
                                />
                            </svg>
                        </span>

                        <h3 class="text-sm font-semibold text-white">
                            Armada Terlaris
                        </h3>

                    </div>

                    <p class="mt-3 text-2xl font-bold text-indigo-400">
                        {{ $armadaTerlaris->armada?->jenis_kendaraan ?? '-' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Armada paling sering digunakan selama periode
                        {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                        {{ $tahun }}.
                    </p>

                </div>


                <div
                    class="
                        shrink-0
                        rounded-xl
                        border
                        border-indigo-500/10
                        bg-indigo-500/5
                        px-5
                        py-4
                        sm:min-w-[150px]
                    "
                >

                    <p class="text-xs text-slate-500">
                        Total penggunaan
                    </p>

                    <p class="mt-1 text-2xl font-bold text-white">
                        {{ $armadaTerlaris->total }}

                        <span class="text-sm font-medium text-slate-500">
                            kali
                        </span>
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        DETAIL RESERVASI
    ========================================================== --}}
    <div
        class="
            overflow-hidden
            rounded-2xl
            border
            border-white/[0.08]
            bg-[#0b1120]
            shadow-xl
            shadow-black/10
        "
    >

        {{-- TABLE HEADER --}}
        <div
            class="
                flex
                flex-col
                gap-2
                border-b
                border-white/[0.06]
                px-6
                py-5
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >

            <div>

                <h3 class="text-base font-semibold text-white">
                    Detail Reservasi
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Daftar transaksi reservasi pada periode laporan.
                </p>

            </div>

            <span
                class="
                    inline-flex
                    w-fit
                    items-center
                    rounded-full
                    border
                    border-slate-700
                    bg-slate-900/70
                    px-3
                    py-1
                    text-[11px]
                    font-medium
                    text-slate-400
                "
            >
                {{ $reservasis->count() }} data
            </span>

        </div>


        @if($reservasis->count())

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1250px] text-sm">

                    <thead
                        class="
                            border-b
                            border-white/[0.06]
                            bg-slate-900/40
                        "
                    >

                        <tr>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-left
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Pelanggan
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-left
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Armada
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-left
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Tujuan
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-left
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Tanggal
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-right
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Harga Final
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-right
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                DP
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-right
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Denda
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-right
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Total Bayar
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-center
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Status Pembayaran
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-left
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Metode
                            </th>

                            <th
                                class="
                                    px-6
                                    py-4
                                    text-center
                                    text-[10px]
                                    font-semibold
                                    uppercase
                                    tracking-[0.14em]
                                    text-slate-500
                                "
                            >
                                Status Reservasi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-white/[0.05]">

                        @foreach($reservasis as $reservasi)

                            <tr
                                class="
                                    transition
                                    hover:bg-white/[0.02]
                                "
                            >

                                {{-- PELANGGAN --}}
                                <td class="px-6 py-4">

                                    <div>

                                        <p class="font-medium text-slate-200">
                                            {{ $reservasi->pelanggan?->nama ?? '-' }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $reservasi->pelanggan?->no_hp ?? '-' }}
                                        </p>

                                    </div>

                                </td>


                                {{-- ARMADA --}}
                                <td class="px-6 py-4">

                                    <p class="font-medium text-slate-300">
                                        {{ $reservasi->armada?->jenis_kendaraan ?? '-' }}
                                    </p>

                                </td>


                                {{-- TUJUAN --}}
                                <td class="max-w-[220px] px-6 py-4">

                                    <p
                                        class="truncate text-slate-400"
                                        title="{{ $reservasi->tujuan ?? '-' }}"
                                    >
                                        {{ $reservasi->tujuan ?? '-' }}
                                    </p>

                                </td>


                                {{-- TANGGAL --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <p class="text-slate-300">
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }}
                                    </p>

                                </td>


                                {{-- HARGA FINAL --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    <span class="font-semibold text-slate-200">
                                        Rp
                                        {{ number_format(
                                            $reservasi->pembayaran?->harga_final ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- DP --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    @if($reservasi->pembayaran && $reservasi->pembayaran->status_pembayaran === 'DP')

                                        <span class="font-medium text-amber-400">
                                            Rp
                                            {{ number_format(
                                                $reservasi->pembayaran->dp ?? 0,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>

                                    @else

                                        <span class="text-slate-600">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- DENDA --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    @if($reservasi->pembayaran && ($reservasi->pembayaran->denda ?? 0) > 0)

                                        <span class="font-medium text-red-400">
                                            Rp
                                            {{ number_format(
                                                $reservasi->pembayaran->denda,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>

                                    @else

                                        <span class="text-slate-600">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- TOTAL BAYAR --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    @if($reservasi->pembayaran)

                                        @php
                                            // Jika status DP, hanya tampilkan DP
                                            // Jika status Lunas, tampilkan total_bayar
                                            $displayTotal = $reservasi->pembayaran->status_pembayaran === 'DP' 
                                                ? $reservasi->pembayaran->dp 
                                                : $reservasi->pembayaran->total_bayar;
                                        @endphp

                                        <span class="font-semibold text-emerald-400">
                                            Rp
                                            {{ number_format($displayTotal ?? 0, 0, ',', '.') }}
                                        </span>

                                    @else

                                        <span class="text-slate-600">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS PEMBAYARAN --}}
                                <td class="px-6 py-4 text-center">

                                    @if($reservasi->pembayaran)

                                        @php
                                            $statusPembayaran =
                                                $reservasi->pembayaran->status_pembayaran;

                                            $statusPembayaranClass = match ($statusPembayaran) {

                                                'Lunas' =>
                                                    'border-emerald-500/20 bg-emerald-500/10 text-emerald-400',

                                                'DP' =>
                                                    'border-amber-500/20 bg-amber-500/10 text-amber-400',

                                                'Belum Bayar' =>
                                                    'border-red-500/20 bg-red-500/10 text-red-400',

                                                default =>
                                                    'border-slate-700 bg-slate-800/50 text-slate-400',
                                            };
                                        @endphp

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                rounded-full
                                                border
                                                px-3
                                                py-1
                                                text-[11px]
                                                font-semibold
                                                {{ $statusPembayaranClass }}
                                            "
                                        >
                                            {{ $statusPembayaran }}
                                        </span>

                                    @else

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                rounded-full
                                                border
                                                border-slate-700
                                                bg-slate-800/50
                                                px-3
                                                py-1
                                                text-[11px]
                                                font-semibold
                                                text-slate-500
                                            "
                                        >
                                            Belum Ada
                                        </span>

                                    @endif

                                </td>


                                {{-- METODE PEMBAYARAN --}}
                                <td class="px-6 py-4">

                                    @if($reservasi->pembayaran?->metode_pembayaran)

                                        <span class="text-slate-400">
                                            {{ $reservasi->pembayaran->metode_pembayaran }}
                                        </span>

                                    @else

                                        <span class="text-slate-600">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS RESERVASI --}}
                                <td class="px-6 py-4 text-center">

                                    @php

                                        $status = $reservasi->status_reservasi;

                                        $statusClass = match ($status) {

                                            'Dikonfirmasi' =>
                                                'border-emerald-500/20 bg-emerald-500/10 text-emerald-400',

                                            'Pending' =>
                                                'border-amber-500/20 bg-amber-500/10 text-amber-400',

                                            'Dibatalkan' =>
                                                'border-red-500/20 bg-red-500/10 text-red-400',

                                            'Diproses' =>
                                                'border-blue-500/20 bg-blue-500/10 text-blue-400',

                                            default =>
                                                'border-slate-700 bg-slate-800/50 text-slate-400',
                                        };

                                    @endphp

                                    <span
                                        class="
                                            inline-flex
                                            items-center
                                            rounded-full
                                            border
                                            px-3
                                            py-1
                                            text-[11px]
                                            font-semibold
                                            {{ $statusClass }}
                                        "
                                    >
                                        {{ $status }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="px-6 py-20 text-center">

                <div
                    class="
                        mx-auto
                        flex
                        h-14
                        w-14
                        items-center
                        justify-center
                        rounded-2xl
                        border
                        border-slate-700
                        bg-slate-900
                        text-slate-600
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 15h6"
                        />
                    </svg>

                </div>

                <h4 class="mt-4 text-sm font-semibold text-slate-300">
                    Tidak ada data reservasi
                </h4>

                <p class="mx-auto mt-1 max-w-sm text-xs leading-5 text-slate-500">
                    Belum terdapat transaksi reservasi pada periode
                    {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                    {{ $tahun }}.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection