<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LaporanService;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    protected LaporanService $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

    /**
     * Halaman preview (HTML)
     */
    public function index(Request $request)
    {
        [$bulan, $tahun] = $this->resolvePeriode($request);

        $data = $this->laporanService->getLaporanBulanan($bulan, $tahun);

        return view('admin.laporan.index', [
            ...$data,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

    /**
     * Export PDF (preview / download)
     */
    public function exportPdf(Request $request)
    {
        [$bulan, $tahun] = $this->resolvePeriode($request);

        $data = $this->laporanService->getLaporanBulanan($bulan, $tahun);

        $pdf = Pdf::loadView('admin.laporan.pdf', [
            ...$data,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $filename = "laporan-$bulan-$tahun.pdf";

        // preview di browser (bisa klik download)
        return $pdf->stream($filename);
    }

    private function resolvePeriode(Request $request): array
    {
        $bulan = (int) ($request->bulan ?? now()->month);
        $tahun = (int) ($request->tahun ?? now()->year);

        return [$bulan, $tahun];
    }
}
