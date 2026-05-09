<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2d3748;
        }

        .container {
            padding: 10px 20px;
        }

        /* HEADER */
        .header {
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #1e293b;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #64748b;
        }

        .meta {
            margin-top: 8px;
            font-size: 11px;
        }

        /* SUMMARY */
        .summary {
            margin: 15px 0;
        }

        .summary-box {
            display: inline-block;
            width: 30%;
            border: 1px solid #e5e7eb;
            padding: 8px;
            margin-right: 1.5%;
            border-radius: 4px;
            text-align: center;
        }

        .summary-title {
            font-size: 10px;
            color: #6b7280;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            margin-top: 4px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #f1f5f9;
            padding: 8px;
            border: 1px solid #d1d5db;
            font-size: 11px;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .small {
            font-size: 10px;
            color: #6b7280;
        }

        /* FOOTER */
        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">
        <h1>Laporan Reservasi Bus Pariwisata</h1>
        <p>Sistem Manajemen Reservasi</p>

        <div class="meta">
            Periode:
            <strong>
                {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}
            </strong>
            <br>
            Dicetak pada:
            {{ now()->translatedFormat('d F Y H:i') }}
        </div>
    </div>

    {{-- SUMMARY --}}
    <div class="summary">

        <div class="summary-box">
            <div class="summary-title">Total Reservasi</div>
            <div class="summary-value">{{ $totalReservasi }}</div>
        </div>

        <div class="summary-box">
            <div class="summary-title">Dikonfirmasi</div>
            <div class="summary-value">{{ $statusSummary['Dikonfirmasi'] ?? 0 }}</div>
        </div>

        <div class="summary-box">
            <div class="summary-title">Dibatalkan</div>
            <div class="summary-value">{{ $statusSummary['Dibatalkan'] ?? 0 }}</div>
        </div>

    </div>

    {{-- TABLE --}}
    <table>
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Armada</th>
                <th>Perjalanan</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reservasis as $reservasi)
            <tr>

                <td>
                    {{ optional($reservasi->pelanggan)->nama ?? '-' }}<br>
                    <span class="small">
                        {{ optional($reservasi->pelanggan)->no_hp ?? '-' }}
                    </span>
                </td>

                <td>
                    {{ optional($reservasi->armada)->jenis_kendaraan ?? '-' }}<br>
                    <span class="small">
                        Kapasitas: {{ optional($reservasi->armada)->kapasitas ?? '-' }}
                    </span>
                </td>

                <td>
                    {{ $reservasi->formatted_tanggal }}<br>
                    {{ $reservasi->formatted_waktu }}<br>
                    <span class="small">
                        {{ $reservasi->tujuan ?? '-' }}
                    </span>
                </td>

                <td class="text-center">
                    {{ $reservasi->status_label }}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        Dicetak oleh sistem pada {{ now()->format('d/m/Y H:i') }}
    </div>

</div>

</body>
</html>