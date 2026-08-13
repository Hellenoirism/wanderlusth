<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Models\Reservasi;
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
                'pembayaran',
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
            ->whereHas('reservasi', function ($query) use (
                $bulan,
                $tahun
            ) {
                $query
                    ->whereMonth(
                        'tanggal_reservasi',
                        $bulan
                    )
                    ->whereYear(
                        'tanggal_reservasi',
                        $tahun
                    );
            });


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalReservasi =
            (clone $reservasiQuery)->count();


        /*
        | Total nilai transaksi:
        |
        | Untuk status DP: hanya hitung DP
        | Untuk status Lunas/Belum Bayar: hitung total_bayar (harga_final + denda)
        */

        $allPembayaran = (clone $pembayaranQuery)->get();
        
        $totalPemasukan = $allPembayaran->sum(function ($pembayaran) {
            if ($pembayaran->status_pembayaran === Pembayaran::STATUS_DP) {
                return $pembayaran->dp ?? 0;
            }
            return $pembayaran->total_bayar ?? 0;
        });


        $totalLunas =
            (clone $pembayaranQuery)
            ->where(
                'status_pembayaran',
                Pembayaran::STATUS_LUNAS
            )
            ->count();


        $totalDP =
            (clone $pembayaranQuery)
            ->where(
                'status_pembayaran',
                Pembayaran::STATUS_DP
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL DENDA
        |--------------------------------------------------------------------------
        */

        $totalDenda =
            (clone $pembayaranQuery)
            ->sum('denda');


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
            ->groupBy('status_reservasi')
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
            ->latest('tanggal_reservasi')
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

            'totalDenda'
            => $totalDenda,

            'statusSummary'
            => $statusSummary,

            'armadaTerlaris'
            => $armadaTerlaris,

            'reservasis'
            => $reservasis,
        ];
    }
}
