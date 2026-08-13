<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Laporan Reservasi</title>

    <style>

        @page {
            margin: 28px 25px 35px 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #1e293b;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 9px;
            margin-bottom: 12px;
        }

        .header h1 {
            margin: 0;
            font-size: 17px;
            color: #172554;
        }

        .header p {
            margin: 3px 0;
            font-size: 9px;
            color: #475569;
        }


        /* =====================================================
           SUMMARY
        ===================================================== */

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 13px;
        }

        .summary-table td {
            width: 25%;
            border: 1px solid #d1d5db;
            padding: 7px 5px;
            text-align: center;
        }

        .summary-title {
            font-size: 8px;
            color: #64748b;
        }

        .summary-value {
            margin-top: 3px;
            font-size: 11px;
            font-weight: bold;
            color: #172554;
        }


        /* =====================================================
           ARMADA TERLARIS
        ===================================================== */

        .armada-box {
            border: 1px solid #d1d5db;
            background: #f8fafc;
            padding: 7px 9px;
            margin-bottom: 13px;
            font-size: 9px;
        }

        .armada-box strong {
            color: #172554;
        }


        /* =====================================================
           DETAIL TABLE
        ===================================================== */

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .detail-table thead {
            display: table-header-group;
        }

        .detail-table th {
            background: #e2e8f0;
            border: 1px solid #cbd5e1;
            padding: 5px 4px;
            font-size: 8px;
            font-weight: bold;
            color: #172554;
            text-align: center;
        }

        .detail-table td {
            border: 1px solid #e2e8f0;
            padding: 5px 4px;
            font-size: 8px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .detail-table tr {
            page-break-inside: avoid;
        }


        /* =====================================================
           COLUMN WIDTH
        ===================================================== */

        .col-pelanggan {
            width: 14%;
        }

        .col-armada {
            width: 11%;
        }

        .col-tujuan {
            width: 14%;
        }

        .col-tanggal {
            width: 11%;
        }

        .col-harga-awal {
            width: 11%;
        }

        .col-harga-final {
            width: 10%;
        }

        .col-dp {
            width: 10%;
        }

        .col-denda {
            width: 8%;
        }

        .col-total {
            width: 10%;
        }

        .col-status {
            width: 9%;
        }


        /* =====================================================
           TEXT
        ===================================================== */

        .small {
            font-size: 7px;
            color: #64748b;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .nowrap {
            white-space: nowrap;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            margin-top: 13px;
            padding-top: 7px;
            border-top: 1px solid #e2e8f0;
            text-align: right;
            font-size: 8px;
            color: #64748b;
        }

    </style>
</head>

<body>

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="header">

    <h1>
        Laporan Reservasi Bus Pariwisata
    </h1>

    <p>
        Periode:
        {{ \Carbon\Carbon::create()
            ->month($bulan)
            ->translatedFormat('F') }}
        {{ $tahun }}
    </p>

    <p>
        Dicetak:
        {{ now()->translatedFormat('d F Y H:i') }}
    </p>

</div>


{{-- =========================================================
     SUMMARY
========================================================= --}}

<table class="summary-table">

    <tr>

        <td>
            <div class="summary-title">
                Total Reservasi
            </div>

            <div class="summary-value">
                {{ $totalReservasi }}
            </div>
        </td>


        <td>
            <div class="summary-title">
                Total Pembayaran
            </div>

            <div class="summary-value">
                Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
            </div>
        </td>


        <td>
            <div class="summary-title">
                Pembayaran Lunas
            </div>

            <div class="summary-value">
                {{ $totalLunas }}
            </div>
        </td>

        <td>
            <div class="summary-title">
                Pembayaran DP
            </div>

            <div class="summary-value">
                {{ $totalDP }}
            </div>
        </td>

    </tr>

</table>


{{-- =========================================================
     ARMADA TERLARIS
========================================================= --}}

@if($armadaTerlaris)

    <div class="armada-box">

        <strong>
            Armada Terlaris:
        </strong>

        {{ $armadaTerlaris->armada?->jenis_kendaraan ?? '-' }}

        — {{ $armadaTerlaris->total }} Reservasi

    </div>

@endif


{{-- =========================================================
     DETAIL RESERVASI
========================================================= --}}

<table class="detail-table">

    <thead>

        <tr>

            <th class="col-pelanggan">
                Pelanggan
            </th>

            <th class="col-armada">
                Armada
            </th>

            <th class="col-tujuan">
                Tujuan
            </th>

            <th class="col-tanggal">
                Tanggal / Waktu
            </th>

            <th class="col-harga-awal">
                Harga Awal
            </th>

            <th class="col-harga-final">
                Harga Final
            </th>

            <th class="col-dp">
                DP
            </th>

            <th class="col-denda">
                Denda
            </th>

            <th class="col-total">
                Total Bayar
            </th>

            <th class="col-status">
                Status
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse($reservasis as $reservasi)

            @php
                $pembayaran = $reservasi->pembayaran;

                $hargaAwal =
                    (float) ($pembayaran?->harga_awal ?? 0);

                $hargaFinal =
                    (float) ($pembayaran?->harga_final ?? 0);

                $dp =
                    (float) ($pembayaran?->dp ?? 0);

                $denda =
                    (float) ($pembayaran?->denda ?? 0);

                // Jika status DP, hanya tampilkan DP
                // Jika status Lunas, tampilkan total (harga_final + denda)
                $totalBayar = ($pembayaran?->status_pembayaran === 'DP')
                    ? $dp
                    : ($hargaFinal + $denda);
            @endphp

            <tr>

                {{-- PELANGGAN --}}
                <td>

                    <strong>
                        {{ $reservasi->pelanggan?->nama ?? '-' }}
                    </strong>

                    @if($reservasi->pelanggan?->no_hp)

                        <br>

                        <span class="small">
                            {{ $reservasi->pelanggan->no_hp }}
                        </span>

                    @endif

                </td>


                {{-- ARMADA --}}
                <td>
                    {{ $reservasi->armada?->jenis_kendaraan ?? '-' }}
                </td>


                {{-- TUJUAN --}}
                <td>
                    {{ $reservasi->tujuan ?? '-' }}
                </td>


                {{-- TANGGAL / WAKTU --}}
                <td class="text-center">

                    {{ \Carbon\Carbon::parse(
                        $reservasi->tanggal_reservasi
                    )->format('d/m/Y') }}

                    @if($reservasi->formatted_waktu)

                        <br>

                        <span class="small">
                            {{ $reservasi->formatted_waktu }}
                        </span>

                    @endif

                </td>


                {{-- HARGA AWAL --}}
                <td class="text-right nowrap">

                    Rp {{ number_format(
                        $hargaAwal,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                {{-- HARGA FINAL --}}
                <td class="text-right nowrap">

                    Rp {{ number_format(
                        $hargaFinal,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                {{-- DP --}}
                <td class="text-right nowrap">

                    @if($pembayaran && $pembayaran->status_pembayaran === 'DP' && $dp > 0)

                        Rp {{ number_format(
                            $dp,
                            0,
                            ',',
                            '.'
                        ) }}

                    @else

                        -

                    @endif

                </td>


                {{-- DENDA --}}
                <td class="text-right nowrap">

                    Rp {{ number_format(
                        $denda,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                {{-- TOTAL BAYAR --}}
                <td class="text-right nowrap font-bold">

                    @if($pembayaran)
                        Rp {{ number_format(
                            $totalBayar,
                            0,
                            ',',
                            '.'
                        ) }}
                    @else
                        -
                    @endif

                </td>


                {{-- STATUS --}}
                <td class="text-center">

                    {{ $pembayaran->status_pembayaran ?? '-' }}

                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="10"
                    class="text-center"
                >
                    Tidak ada data reservasi pada periode ini.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>


{{-- =========================================================
     FOOTER
========================================================= --}}

<div class="footer">

    Dicetak oleh sistem pada
    {{ now()->format('d/m/Y H:i') }}

</div>

</body>
</html>