<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function Symfony\Component\Clock\now;

class DashboardController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;

        $reservasiPerBulan = DB::table('reservasis')
            ->selectRaw('MONTH(tanggal_reservasi) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_reservasi', $year)
            ->whereNotNull('tanggal_reservasi')
            ->where('status_reservasi', 'Dikonfirmasi')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('M', mktime(0, 0, 0, $i, 1)) . ' ' . $year;
            $data[] = $reservasiPerBulan[$i] ?? 0;
        }

        return view('admin.dashboard', [
            'totalArmada' => Armada::count(),
            'confirmedReservasi' => Reservasi::where('status_reservasi', 'Dikonfirmasi')->count(),
            'pendingReservasi' => Reservasi::where('status_reservasi', 'Pending')->count(),
            'totalReservasi' => Reservasi::count(),
            'todayReservasi' => Reservasi::whereDate('created_at', now())->count(),
            'recentReservasi' => Reservasi::with(['pelanggan', 'armada'])
                ->latest('tanggal_reservasi')
                ->take(5)
                ->get(),

            'chartLabels' => $labels,
            'chartData' => $data,
        ]);
    }
}