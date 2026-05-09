<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $status = $request->status;

        $query = Pembayaran::with([
            'reservasi.armada',
            'reservasi.pelanggan'
        ]);

        /*
        |--------------------------------------------------------------------------
        | FILTER BULAN
        |--------------------------------------------------------------------------
        */

        if ($bulan) {
            $query->whereMonth('tanggal_pembayaran', $bulan);
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER TAHUN
        |--------------------------------------------------------------------------
        */

        if ($tahun) {
            $query->whereYear('tanggal_pembayaran', $tahun);
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($status) {
            $query->where('status_pembayaran', $status);
        }

        $pembayarans = $query
            ->latest('id_pembayaran')
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalPendapatan = (clone $query)->sum('total_bayar');

        $totalPiutang = (clone $query)->sum('sisa_pembayaran');

        $totalLunas = (clone $query)
            ->where('status_pembayaran', Pembayaran::STATUS_LUNAS)
            ->count();

        $totalDP = (clone $query)
            ->where('status_pembayaran', Pembayaran::STATUS_DP)
            ->count();

        return view('admin.pembayaran.index', compact(
            'pembayarans',
            'totalPendapatan',
            'totalPiutang',
            'totalLunas',
            'totalDP'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Reservasi $reservasi)
    {
        $reservasi->load([
            'armada',
            'pelanggan'
        ]);

        if ($reservasi->pembayaran) {

            return redirect()
                ->route('admin.pembayaran.index')
                ->with('error', 'Reservasi sudah memiliki pembayaran.');
        }

        return view('admin.pembayaran.create', compact('reservasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_reservasi' => [
                'required',
                'exists:reservasis,id_reservasi',
                'unique:pembayarans,id_reservasi'
            ],

            'harga_awal' => 'required|numeric|min:0',

            'harga_final' => 'required|numeric|min:0',

            'dp' => 'nullable|numeric|min:0',

            'total_bayar' => 'required|numeric|min:0',

            'metode_pembayaran' => 'nullable|string|max:255',
        ]);

        /*
        |--------------------------------------------------------------------------
        | HITUNG SISA PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $sisaPembayaran =
            $validated['harga_final'] - $validated['total_bayar'];

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI NEGATIVE VALUE
        |--------------------------------------------------------------------------
        */

        if ($sisaPembayaran < 0) {
            $sisaPembayaran = 0;
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        if ($validated['total_bayar'] <= 0) {

            $status = Pembayaran::STATUS_BELUM_BAYAR;
        } elseif ($validated['total_bayar'] < $validated['harga_final']) {

            $status = Pembayaran::STATUS_DP;
        } else {

            $status = Pembayaran::STATUS_LUNAS;
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        Pembayaran::create([
            'id_reservasi' => $validated['id_reservasi'],

            'harga_awal' => $validated['harga_awal'],

            'harga_final' => $validated['harga_final'],

            'dp' => $validated['dp'] ?? 0,

            'total_bayar' => $validated['total_bayar'],

            'sisa_pembayaran' => $sisaPembayaran,

            'status_pembayaran' => $status,

            'metode_pembayaran' => $validated['metode_pembayaran'],

            'tanggal_pembayaran' => now(),
        ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load([
            'reservasi.armada',
            'reservasi.pelanggan'
        ]);

        return view('admin.pembayaran.show', compact('pembayaran'));
    }
}