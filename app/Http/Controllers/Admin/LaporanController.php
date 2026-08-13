<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct(
        protected LaporanService $laporanService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        [$bulan, $tahun] =
            $this->resolvePeriode($request);

        $data =
            $this->laporanService
            ->getLaporanBulanan(
                $bulan,
                $tahun
            );

        return view(
            'admin.laporan.index',
            [
                ...$data,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    public function exportPdf(Request $request)
    {
        [$bulan, $tahun] =
            $this->resolvePeriode($request);

        $data =
            $this->laporanService
            ->getLaporanBulanan(
                $bulan,
                $tahun
            );

        $pdf = Pdf::loadView(
            'admin.laporan.pdf',
            [
                ...$data,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | LANDSCAPE
        |--------------------------------------------------------------------------
        |
        | 9 kolom laporan membutuhkan ruang horizontal.
        |
        */

        $pdf->setPaper('a4', 'landscape');

        $filename =
            "laporan-reservasi-{$bulan}-{$tahun}.pdf";

        return $pdf->stream($filename);
    }


    /*
    |--------------------------------------------------------------------------
    | PERIODE
    |--------------------------------------------------------------------------
    */

    private function resolvePeriode(
        Request $request
    ): array {

        $bulan = (int) (
            $request->bulan
            ?? now()->month
        );

        $tahun = (int) (
            $request->tahun
            ?? now()->year
        );

        /*
        |--------------------------------------------------------------------------
        | Safety validation
        |--------------------------------------------------------------------------
        */

        if ($bulan < 1 || $bulan > 12) {
            $bulan = now()->month;
        }

        if ($tahun < 2000 || $tahun > 2100) {
            $tahun = now()->year;
        }

        return [
            $bulan,
            $tahun,
        ];
    }
}
