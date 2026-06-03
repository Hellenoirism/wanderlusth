@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan Bulanan')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>

        <h2 class="text-2xl font-bold text-white">
            Laporan Bulanan
        </h2>

        <p class="text-sm text-blue-300">
            Periode
            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
            {{ $tahun }}
        </p>

    </div>

    {{-- FILTER --}}
    <div class="flex flex-wrap items-center justify-between gap-3">

        <form
            method="GET"
            class="flex flex-wrap gap-3"
        >

            <select
                name="bulan"
                class="rounded-lg bg-white px-3 py-2 pr-8 text-sm text-black"
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

            <select
                name="tahun"
                class="rounded-lg bg-white px-3 py-2 pr-8 text-sm text-black"
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

            <button
                class="
                    rounded-lg
                    bg-indigo-600
                    px-4 py-2
                    text-sm text-white
                    transition
                    hover:bg-indigo-700
                "
            >

                Filter

            </button>

        </form>

        <a
            href="{{ route('admin.laporan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
            target="_blank"
            class="
                rounded-lg
                bg-red-600
                px-4 py-2
                text-sm text-white
                transition
                hover:bg-red-700
            "
        >

            Export PDF

        </a>

    </div>

    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-5">

        <div class="rounded-xl border bg-white p-5 shadow">

            <p class="text-sm text-slate-500">
                Total Reservasi
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-800">
                {{ $totalReservasi }}
            </p>

        </div>

        <div class="rounded-xl border bg-white p-5 shadow">

            <p class="text-sm text-slate-500">
                Total Pemasukan
            </p>

            <p
                class="mt-2 text-2xl font-bold text-green-600"
                data-currency-text="{{ $totalPemasukan }}"
            >
            </p>

        </div>

        <div class="rounded-xl border bg-white p-5 shadow">

            <p class="text-sm text-slate-500">
                Pembayaran Lunas
            </p>

            <p class="mt-2 text-3xl font-bold text-blue-600">
                {{ $totalLunas }}
            </p>

        </div>

        <div class="rounded-xl border bg-white p-5 shadow">

            <p class="text-sm text-slate-500">
                Pembayaran DP
            </p>

            <p class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $totalDP }}
            </p>

        </div>

        <div class="rounded-xl border bg-white p-5 shadow">

            <p class="text-sm text-slate-500">
                Sisa Piutang
            </p>

            <p
                class="mt-2 text-2xl font-bold text-red-600"
                data-currency-text="{{ $totalPiutang }}"
            >
            </p>

        </div>

    </div>

    {{-- ARMADA TERLARIS --}}
    @if($armadaTerlaris)

    <div class="rounded-2xl border bg-white p-6 shadow">

        <h3 class="text-lg font-bold text-slate-800">
            Armada Terlaris
        </h3>

        <div class="mt-3">

            <p class="text-2xl font-semibold text-indigo-600">

                {{ $armadaTerlaris->armada?->jenis_kendaraan }}

            </p>

            <p class="text-sm text-slate-500">

                Digunakan
                {{ $armadaTerlaris->total }}
                kali selama periode ini

            </p>

        </div>

    </div>

    @endif

    {{-- TABEL --}}
    <div class="overflow-hidden rounded-2xl border bg-white shadow">

        @if($reservasis->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead
                    class="
                        bg-slate-100
                        text-xs
                        uppercase
                        tracking-wide
                        text-slate-700
                    "
                >

                    <tr>

                        <th class="px-5 py-4 text-left">
                            Pelanggan
                        </th>

                        <th class="px-5 py-4 text-left">
                            Armada
                        </th>

                        <th class="px-5 py-4 text-left">
                            Tujuan
                        </th>

                        <th class="px-5 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 text-left">
                            Harga Final
                        </th>

                        <th class="px-5 py-4 text-left">
                            Pembayaran
                        </th>

                        <th class="px-5 py-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-200">

                    @foreach($reservasis as $reservasi)

                    <tr class="transition hover:bg-slate-50">

                        {{-- PELANGGAN --}}
                        <td class="px-5 py-4">

                            <p class="font-semibold text-slate-800">

                                {{ $reservasi->pelanggan?->nama ?? '-' }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $reservasi->pelanggan?->no_hp ?? '-' }}

                            </p>

                        </td>

                        {{-- ARMADA --}}
                        <td class="px-5 py-4">

                            <p class="font-medium text-slate-800">

                                {{ $reservasi->armada?->jenis_kendaraan ?? '-' }}

                            </p>

                        </td>

                        {{-- TUJUAN --}}
                        <td class="px-5 py-4">

                            {{ $reservasi->tujuan ?? '-' }}

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-5 py-4">

                            {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }}

                        </td>

                        {{-- HARGA --}}
                        <td class="px-5 py-4">

                            <span
                                data-currency-text="{{ $reservasi->pembayaran?->harga_final ?? 0 }}"
                            >
                            </span>

                        </td>

                        {{-- PEMBAYARAN --}}
                        <td class="px-5 py-4">

                            @if($reservasi->pembayaran)

                                <div>

                                    <p
                                        class="font-semibold text-green-600"
                                        data-currency-text="{{ $reservasi->pembayaran->total_bayar }}"
                                    >
                                    </p>

                                    <p
                                        class="text-xs text-red-500"
                                        data-currency-text="{{ $reservasi->pembayaran->sisa_pembayaran }}"
                                    >
                                    </p>

                                </div>

                            @else

                                -

                            @endif

                        </td>

                        {{-- STATUS --}}
                        <td class="px-5 py-4 text-center">

                            <span
                                @class([
                                    'rounded-full px-3 py-1 text-xs font-semibold',

                                    'bg-green-100 text-green-700'
                                        => $reservasi->status_reservasi === 'Dikonfirmasi',

                                    'bg-yellow-100 text-yellow-700'
                                        => $reservasi->status_reservasi === 'Pending',

                                    'bg-red-100 text-red-700'
                                        => $reservasi->status_reservasi === 'Dibatalkan',

                                    'bg-slate-100 text-slate-700'
                                        => !in_array(
                                            $reservasi->status_reservasi,
                                            [
                                                'Pending',
                                                'Dikonfirmasi',
                                                'Dibatalkan'
                                            ]
                                        ),
                                ])
                            >

                                {{ $reservasi->status_reservasi }}

                            </span>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="py-16 text-center">

            <p class="text-sm text-slate-500">
                Tidak ada data pada periode ini.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection