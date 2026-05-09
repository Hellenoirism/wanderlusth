<?php

namespace App\Services;

use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;

class LaporanService
{
    public function getLaporanBulanan(int $bulan, int $tahun): array
    {
        $query = Reservasi::query()
            ->with(['pelanggan', 'armada']) // eager loading (important)
            ->whereMonth('tanggal_reservasi', $bulan)
            ->whereYear('tanggal_reservasi', $tahun);

        return [
            'totalReservasi' => (clone $query)->count(),

            'statusSummary' => (clone $query)
                ->select('status_reservasi', DB::raw('COUNT(*) as total'))
                ->groupBy('status_reservasi')
                ->pluck('total', 'status_reservasi'),

            'reservasis' => (clone $query)
                ->latest('tanggal_reservasi')
                ->get(),
        ];
    }
}
