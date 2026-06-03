<?php

namespace App\Services;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class LaporanService
{
    public function getLaporanBulanan(
        int $bulan,
        int $tahun
    ): array {

        /*
        |--------------------------------------------------------------------------
        | RESERVASI
        |--------------------------------------------------------------------------
        */

        $reservasiQuery = Reservasi::query()
            ->with([
                'pelanggan',
                'armada',
                'pembayaran'
            ])
            ->whereMonth(
                'tanggal_reservasi',
                $bulan
            )
            ->whereYear(
                'tanggal_reservasi',
                $tahun
            );

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $pembayaranQuery = Pembayaran::query()
            ->whereMonth(
                'tanggal_pembayaran',
                $bulan
            )
            ->whereYear(
                'tanggal_pembayaran',
                $tahun
            );

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalReservasi =
            (clone $reservasiQuery)->count();

        $totalPemasukan =
            (clone $pembayaranQuery)
            ->sum('total_bayar');

        $totalLunas =
            (clone $pembayaranQuery)
            ->where(
                'status_pembayaran',
                'Lunas'
            )
            ->count();

        $totalDP =
            (clone $pembayaranQuery)
            ->where(
                'status_pembayaran',
                'DP'
            )
            ->count();

        $totalPiutang =
            (clone $pembayaranQuery)
            ->sum('sisa_pembayaran');

        /*
        |--------------------------------------------------------------------------
        | STATUS RESERVASI
        |--------------------------------------------------------------------------
        */

        $statusSummary =
            (clone $reservasiQuery)
            ->select(
                'status_reservasi',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy(
                'status_reservasi'
            )
            ->pluck(
                'total',
                'status_reservasi'
            );

        /*
        |--------------------------------------------------------------------------
        | ARMADA TERLARIS
        |--------------------------------------------------------------------------
        */

        $armadaTerlaris =
            (clone $reservasiQuery)
            ->select(
                'id_armada',
                DB::raw('COUNT(*) as total')
            )
            ->with('armada')
            ->groupBy('id_armada')
            ->orderByDesc('total')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | DETAIL RESERVASI
        |--------------------------------------------------------------------------
        */

        $reservasis =
            (clone $reservasiQuery)
            ->latest(
                'tanggal_reservasi'
            )
            ->get();

        return [

            'totalReservasi'
            => $totalReservasi,

            'totalPemasukan'
            => $totalPemasukan,

            'totalLunas'
            => $totalLunas,

            'totalDP'
            => $totalDP,

            'totalPiutang'
            => $totalPiutang,

            'statusSummary'
            => $statusSummary,

            'armadaTerlaris'
            => $armadaTerlaris,

            'reservasis'
            => $reservasis,
        ];
    }
}
