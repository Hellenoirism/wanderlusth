<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $reservasis = Reservasi::query()
            ->with([
                'pelanggan',
                'armada',
                'pembayaran',
            ])
            ->whereIn('status_reservasi', [
                Reservasi::STATUS_PENDING,
                Reservasi::STATUS_PROCESS,
                Reservasi::STATUS_CONFIRMED,
            ])
            ->latest('id_reservasi')
            ->paginate(10);

        return view(
            'admin.pembayaran.index',
            compact('reservasis')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Reservasi $reservasi)
    {
        $reservasi->load([
            'pelanggan',
            'armada',
            'pembayaran',
        ]);

        if ($reservasi->isCancelled()) {

            return redirect()
                ->route('admin.pembayaran.index')
                ->with('error', 'Reservasi dibatalkan.');
        }

        if ($reservasi->pembayaran) {

            return redirect()
                ->route('admin.pembayaran.edit', $reservasi->pembayaran)
                ->with('error', 'Reservasi sudah memiliki pembayaran.');
        }

        $defaultHargaAwal =
            $reservasi->armada?->harga_sewa;

        return view(
            'admin.pembayaran.create',
            compact(
                'reservasi',
                'defaultHargaAwal'
            )
        );
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
                'unique:pembayarans,id_reservasi',
            ],

            'jenis_pembayaran' => [
                'required',
                'in:DP,Lunas',
            ],

            'harga_awal' => [
                'required',
                'numeric',
                'min:0',
            ],

            'harga_final' => [
                'required',
                'numeric',
                'min:0',
            ],

            'dp' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'metode_pembayaran' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $reservasi = Reservasi::with('pembayaran')
            ->findOrFail($validated['id_reservasi']);

        if ($reservasi->isCancelled()) {
            return back()
                ->withInput()
                ->with('error', 'Reservasi dibatalkan.');
        }

        if ($reservasi->pembayaran) {
            return back()
                ->withInput()
                ->with('error', 'Reservasi sudah memiliki pembayaran.');
        }

        DB::transaction(function () use ($validated, $reservasi) {

            $hargaFinal = (float) $validated['harga_final'];

            $isLunas =
                $validated['jenis_pembayaran'] === 'Lunas';

            $dp = $isLunas
                ? $hargaFinal
                : (float) ($validated['dp'] ?? 0);

            if (!$isLunas) {

                if ($dp <= 0) {
                    throw ValidationException::withMessages([
                        'dp' => 'Nominal DP harus lebih dari 0.',
                    ]);
                }

                if ($dp >= $hargaFinal) {
                    throw ValidationException::withMessages([
                        'dp' => 'Nominal DP harus lebih kecil dari harga final.',
                    ]);
                }
            }

            $totalBayar = $dp;

            $sisaPembayaran =
                $hargaFinal - $totalBayar;

            $statusPembayaran =
                $sisaPembayaran <= 0
                ? Pembayaran::STATUS_LUNAS
                : Pembayaran::STATUS_DP;

            Pembayaran::create([
                'id_reservasi'       => $reservasi->id_reservasi,
                'harga_awal'         => $validated['harga_awal'],
                'harga_final'        => $hargaFinal,
                'dp'                 => $dp,
                'total_bayar'        => $totalBayar,
                'sisa_pembayaran'    => $sisaPembayaran,
                'status_pembayaran'  => $statusPembayaran,
                'metode_pembayaran'  => $validated['metode_pembayaran'],
                'tanggal_pembayaran' => now(),
            ]);

            $reservasi->update([
                'status_reservasi' =>
                $statusPembayaran === Pembayaran::STATUS_LUNAS
                    ? Reservasi::STATUS_CONFIRMED
                    : Reservasi::STATUS_PROCESS,
            ]);
        });

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load([
            'reservasi.pelanggan',
            'reservasi.armada',
        ]);

        return view(
            'admin.pembayaran.edit',
            compact('pembayaran')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DENDA
    |--------------------------------------------------------------------------
    */

    public function createDenda(Pembayaran $pembayaran)
    {
        // Denda hanya boleh diberikan jika pembayaran sudah lunas
        if ($pembayaran->status_pembayaran !== Pembayaran::STATUS_LUNAS) {
            return redirect()
                ->route('admin.pembayaran.index')
                ->with(
                    'error',
                    'Denda hanya dapat diberikan pada pembayaran yang sudah lunas.'
                );
        }

        $pembayaran->load([
            'reservasi.pelanggan',
            'reservasi.armada',
        ]);

        return view(
            'admin.pembayaran.denda.create',
            compact('pembayaran')
        );
    }


    /**
     * Simpan denda
     */
    public function storeDenda(
        Request $request,
        Pembayaran $pembayaran
    ) {
        // Pastikan hanya pembayaran Lunas
        if ($pembayaran->status_pembayaran !== Pembayaran::STATUS_LUNAS) {
            abort(403, 'Denda hanya dapat diberikan pada pembayaran yang sudah lunas.');
        }

        // Validasi nominal denda
        $validated = $request->validate([
            'denda' => [
                'required',
                'numeric',
                'min:1',
            ],
        ], [
            'denda.required' => 'Nominal denda wajib diisi.',
            'denda.numeric' => 'Nominal denda harus berupa angka.',
            'denda.min' => 'Nominal denda harus lebih dari Rp 0.',
        ]);

        // Simpan denda
        $pembayaran->update([
            'denda' => $validated['denda'],
        ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Denda berhasil ditambahkan.');
    }


    /**
     * Form edit denda
     */
    public function editDenda(Pembayaran $pembayaran)
    {
        // Denda hanya boleh diedit jika pembayaran sudah lunas
        if ($pembayaran->status_pembayaran !== Pembayaran::STATUS_LUNAS) {
            return redirect()
                ->route('admin.pembayaran.index')
                ->with(
                    'error',
                    'Denda hanya dapat diubah pada pembayaran yang sudah lunas.'
                );
        }

        $pembayaran->load([
            'reservasi.pelanggan',
            'reservasi.armada',
        ]);

        return view(
            'admin.pembayaran.denda.edit',
            compact('pembayaran')
        );
    }


    /**
     * Update denda
     */
    public function updateDenda(
        Request $request,
        Pembayaran $pembayaran
    ) {
        // Pastikan pembayaran masih Lunas
        if ($pembayaran->status_pembayaran !== Pembayaran::STATUS_LUNAS) {
            abort(403, 'Denda hanya dapat diperbarui pada pembayaran yang sudah lunas.');
        }

        // Validasi nominal baru
        $validated = $request->validate([
            'denda' => [
                'required',
                'numeric',
                'min:1',
            ],
        ], [
            'denda.required' => 'Nominal denda wajib diisi.',
            'denda.numeric' => 'Nominal denda harus berupa angka.',
            'denda.min' => 'Nominal denda harus lebih dari Rp 0.',
        ]);

        // Update denda
        $pembayaran->update([
            'denda' => $validated['denda'],
        ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Denda berhasil diperbarui.');
    }
    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'total_bayar' => [
                'required',
                'numeric',
                'min:0',
            ],

            'metode_pembayaran' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        DB::transaction(function () use ($validated, $pembayaran) {

            $hargaFinal =
                (float) $pembayaran->harga_final;

            $totalBayar =
                (float) $validated['total_bayar'];

            if ($totalBayar > $hargaFinal) {
                throw ValidationException::withMessages([
                    'total_bayar' =>
                    'Total pembayaran tidak boleh melebihi harga final.',
                ]);
            }

            $sisaPembayaran =
                $hargaFinal - $totalBayar;

            $statusPembayaran =
                $sisaPembayaran <= 0
                ? Pembayaran::STATUS_LUNAS
                : Pembayaran::STATUS_DP;

            $pembayaran->update([
                'total_bayar'       => $totalBayar,
                'sisa_pembayaran'   => $sisaPembayaran,
                'status_pembayaran' => $statusPembayaran,
                'metode_pembayaran' => $validated['metode_pembayaran'],
            ]);

            $pembayaran->reservasi->update([
                'status_reservasi' =>
                $statusPembayaran === Pembayaran::STATUS_LUNAS
                    ? Reservasi::STATUS_CONFIRMED
                    : Reservasi::STATUS_PROCESS,
            ]);
        });

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }
}
