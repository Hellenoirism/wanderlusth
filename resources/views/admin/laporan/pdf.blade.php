<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:11px;
            color:#1e293b;
        }

        .header{
            border-bottom:2px solid #4f46e5;
            padding-bottom:10px;
            margin-bottom:15px;
        }

        .header h1{
            margin:0;
            font-size:18px;
        }

        .header p{
            margin:2px 0;
        }

        .summary-table{
            width:100%;
            margin-bottom:15px;
        }

        .summary-table td{
            width:20%;
            border:1px solid #d1d5db;
            padding:8px;
            text-align:center;
        }

        .summary-title{
            font-size:10px;
            color:#64748b;
        }

        .summary-value{
            font-size:14px;
            font-weight:bold;
            margin-top:4px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#f1f5f9;
            border:1px solid #cbd5e1;
            padding:6px;
            font-size:10px;
        }

        td{
            border:1px solid #e2e8f0;
            padding:6px;
            font-size:10px;
            vertical-align:top;
        }

        .small{
            font-size:9px;
            color:#64748b;
        }

        .text-center{
            text-align:center;
        }

        .footer{
            margin-top:15px;
            text-align:right;
            font-size:10px;
            color:#64748b;
        }

        .armada-box{
            border:1px solid #d1d5db;
            padding:10px;
            margin-bottom:15px;
        }

    </style>
</head>
<body>

<div class="header">

    <h1>Laporan Reservasi Bus Pariwisata</h1>

    <p>
        Periode
        {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
        {{ $tahun }}
    </p>

    <p>
        Dicetak:
        {{ now()->translatedFormat('d F Y H:i') }}
    </p>

</div>

{{-- SUMMARY --}}
<table class="summary-table">
    <tr>

        <td>
            <div class="summary-title">Total Reservasi</div>
            <div class="summary-value">
                {{ $totalReservasi }}
            </div>
        </td>

        <td>
            <div class="summary-title">Total Pemasukan</div>
            <div class="summary-value">
                Rp {{ number_format($totalPemasukan,0,',','.') }}
            </div>
        </td>

        <td>
            <div class="summary-title">Pembayaran Lunas</div>
            <div class="summary-value">
                {{ $totalLunas }}
            </div>
        </td>

        <td>
            <div class="summary-title">Pembayaran DP</div>
            <div class="summary-value">
                {{ $totalDP }}
            </div>
        </td>

        <td>
            <div class="summary-title">Sisa Piutang</div>
            <div class="summary-value">
                Rp {{ number_format($totalPiutang,0,',','.') }}
            </div>
        </td>

    </tr>
</table>

{{-- ARMADA TERLARIS --}}
@if($armadaTerlaris)

<div class="armada-box">

    <strong>Armada Terlaris</strong><br>

    {{ $armadaTerlaris->armada?->jenis_kendaraan ?? '-' }}

    ({{ $armadaTerlaris->total }} Reservasi)

</div>

@endif

{{-- DETAIL RESERVASI --}}
<table>

    <thead>

        <tr>

            <th>Pelanggan</th>
            <th>Armada</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Harga Final</th>
            <th>Total Bayar</th>
            <th>Sisa</th>
            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @forelse($reservasis as $reservasi)

            <tr>

                <td>

                    {{ $reservasi->pelanggan?->nama ?? '-' }}

                    <br>

                    <span class="small">
                        {{ $reservasi->pelanggan?->no_hp ?? '-' }}
                    </span>

                </td>

                <td>
                    {{ $reservasi->armada?->jenis_kendaraan ?? '-' }}
                </td>

                <td>
                    {{ $reservasi->tujuan ?? '-' }}
                </td>

                <td>

                    {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d/m/Y') }}

                    <br>

                    <span class="small">
                        {{ $reservasi->formatted_waktu }}
                    </span>

                </td>

                <td>

                    Rp
                    {{ number_format($reservasi->pembayaran?->harga_final ?? 0,0,',','.') }}

                </td>

                <td>

                    Rp
                    {{ number_format($reservasi->pembayaran?->total_bayar ?? 0,0,',','.') }}

                </td>

                <td>

                    Rp
                    {{ number_format($reservasi->pembayaran?->sisa_pembayaran ?? 0,0,',','.') }}

                </td>

                <td class="text-center">
                    {{ $reservasi->status_reservasi }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="8" class="text-center">
                    Tidak ada data
                </td>

            </tr>

        @endforelse

    </tbody>

</table>

<div class="footer">

    Dicetak oleh sistem pada
    {{ now()->format('d/m/Y H:i') }}

</div>

</body>
</html>