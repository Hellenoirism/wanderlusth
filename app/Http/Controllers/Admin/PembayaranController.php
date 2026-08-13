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
                ->route(
                    'admin.pembayaran.edit',
                    $reservasi->pembayaran
                )
                ->with(
                    'error',
                    'Reservasi sudah memiliki pembayaran.'
                );
        }

        $defaultHargaAwal = $reservasi->armada?->harga_sewa;

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
    | STORE PEMBAYARAN
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
                ->with(
                    'error',
                    'Reservasi dibatalkan.'
                );
        }

        if ($reservasi->pembayaran) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Reservasi sudah memiliki pembayaran.'
                );
        }

        DB::transaction(function () use (
            $validated,
            $reservasi
        ) {

            $hargaAwal = (float) $validated['harga_awal'];
            $hargaFinal = (float) $validated['harga_final'];

            /*
            |--------------------------------------------------------------------------
            | HARGA FINAL
            |--------------------------------------------------------------------------
            |
            | Harga final boleh lebih kecil dari harga awal
            | karena adanya diskon.
            |
            */

            if ($hargaFinal < 0) {
                throw ValidationException::withMessages([
                    'harga_final' =>
                    'Harga final tidak boleh kurang dari Rp 0.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | TENTUKAN DP
            |--------------------------------------------------------------------------
            */

            if ($validated['jenis_pembayaran'] === 'Lunas') {
                $dp = $hargaFinal;
            } else {
                $dp = (float) ($validated['dp'] ?? 0);
            }

            /*
            |--------------------------------------------------------------------------
            | VALIDASI DP
            |--------------------------------------------------------------------------
            */

            if ($dp < 0) {
                throw ValidationException::withMessages([
                    'dp' =>
                    'Nominal pembayaran tidak boleh kurang dari Rp 0.',
                ]);
            }

            if ($dp > $hargaFinal) {
                throw ValidationException::withMessages([
                    'dp' =>
                    'Nominal pembayaran tidak boleh melebihi harga final.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STATUS PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $statusPembayaran = $this->determinePaymentStatus(
                $dp,
                $hargaFinal
            );

            /*
            |--------------------------------------------------------------------------
            | DENDA
            |--------------------------------------------------------------------------
            |
            | Pada saat pembayaran dibuat belum ada denda.
            |
            */

            $denda = 0;

            /*
            |--------------------------------------------------------------------------
            | SISA PEMBAYARAN
            |--------------------------------------------------------------------------
            |
            | Rumus:
            |
            | sisa_pembayaran = harga_final - dp
            |
            */

            $sisaPembayaran = max(
                $hargaFinal - $dp,
                0
            );

            /*
            |--------------------------------------------------------------------------
            | TOTAL BAYAR
            |--------------------------------------------------------------------------
            |
            | Rumus:
            |
            | total_bayar = harga_final + denda
            |
            */

            $totalBayar =
                $hargaFinal + $denda;

            /*
            |--------------------------------------------------------------------------
            | SIMPAN PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            Pembayaran::create([
                'id_reservasi' =>
                $reservasi->id_reservasi,

                'harga_awal' =>
                $hargaAwal,

                'harga_final' =>
                $hargaFinal,

                'dp' =>
                $dp,

                'sisa_pembayaran' =>
                $sisaPembayaran,

                'denda' =>
                $denda,

                'total_bayar' =>
                $totalBayar,

                'status_pembayaran' =>
                $statusPembayaran,

                'metode_pembayaran' =>
                $validated['metode_pembayaran'],

                'tanggal_pembayaran' =>
                now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS RESERVASI
            |--------------------------------------------------------------------------
            */

            $reservasi->update([
                'status_reservasi' =>
                $this->determineReservationStatus(
                    $statusPembayaran
                ),
            ]);
        });

        return redirect()
            ->route('admin.pembayaran.index')
            ->with(
                'success',
                'Pembayaran berhasil ditambahkan.'
            );
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
    | UPDATE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Pembayaran $pembayaran
    ) {
        $validated = $request->validate([
            'dp' => [
                'required',
                'numeric',
                'min:0',
            ],

            'metode_pembayaran' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'dp.required' =>
            'Nominal pembayaran wajib diisi.',

            'dp.numeric' =>
            'Nominal pembayaran harus berupa angka.',

            'dp.min' =>
            'Nominal pembayaran tidak boleh kurang dari Rp 0.',

            'metode_pembayaran.required' =>
            'Metode pembayaran wajib dipilih.',
        ]);

        DB::transaction(function () use (
            $validated,
            $pembayaran
        ) {

            $hargaFinal =
                (float) $pembayaran->harga_final;

            $dpBaru =
                (float) $validated['dp'];

            $denda =
                (float) ($pembayaran->denda ?? 0);

            /*
            |--------------------------------------------------------------------------
            | VALIDASI DP
            |--------------------------------------------------------------------------
            */

            if ($dpBaru > $hargaFinal) {
                throw ValidationException::withMessages([
                    'dp' =>
                    'Nominal pembayaran tidak boleh melebihi harga final sebesar Rp ' .
                        number_format(
                            $hargaFinal,
                            0,
                            ',',
                            '.'
                        ) . '.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STATUS PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $statusPembayaran = $this->determinePaymentStatus(
                $dpBaru,
                $hargaFinal
            );

            /*
            |--------------------------------------------------------------------------
            | SISA PEMBAYARAN
            |--------------------------------------------------------------------------
            |
            | harga_final - dp
            |
            */

            $sisaPembayaran = max(
                $hargaFinal - $dpBaru,
                0
            );

            /*
            |--------------------------------------------------------------------------
            | TOTAL BAYAR
            |--------------------------------------------------------------------------
            |
            | harga_final + denda
            |
            */

            $totalBayar =
                $hargaFinal + $denda;

            /*
            |--------------------------------------------------------------------------
            | UPDATE PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $pembayaran->update([
                'dp' =>
                $dpBaru,

                'sisa_pembayaran' =>
                $sisaPembayaran,

                'denda' =>
                $denda,

                'total_bayar' =>
                $totalBayar,

                'metode_pembayaran' =>
                $validated['metode_pembayaran'],

                'status_pembayaran' =>
                $statusPembayaran,
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS RESERVASI
            |--------------------------------------------------------------------------
            */

            $pembayaran->reservasi->update([
                'status_reservasi' =>
                $this->determineReservationStatus(
                    $statusPembayaran
                ),
            ]);
        });

        return redirect()
            ->route('admin.pembayaran.index')
            ->with(
                'success',
                'Pembayaran berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DENDA - CREATE
    |--------------------------------------------------------------------------
    */

    public function createDenda(Pembayaran $pembayaran)
    {
        if (
            $pembayaran->status_pembayaran
            !== Pembayaran::STATUS_LUNAS
        ) {
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


    /*
    |--------------------------------------------------------------------------
    | DENDA - STORE
    |--------------------------------------------------------------------------
    */

    public function storeDenda(
        Request $request,
        Pembayaran $pembayaran
    ) {
        if (
            $pembayaran->status_pembayaran
            !== Pembayaran::STATUS_LUNAS
        ) {
            abort(
                403,
                'Denda hanya dapat diberikan pada pembayaran yang sudah lunas.'
            );
        }

        $validated = $request->validate([
            'denda' => [
                'required',
                'numeric',
                'min:1',
            ],
        ], [
            'denda.required' =>
            'Nominal denda wajib diisi.',

            'denda.numeric' =>
            'Nominal denda harus berupa angka.',

            'denda.min' =>
            'Nominal denda harus lebih dari Rp 0.',
        ]);

        DB::transaction(function () use (
            $validated,
            $pembayaran
        ) {

            $hargaFinal =
                (float) $pembayaran->harga_final;

            $dp =
                (float) $pembayaran->dp;

            $denda =
                (float) $validated['denda'];

            /*
            |--------------------------------------------------------------------------
            | SISA PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $sisaPembayaran = max(
                $hargaFinal - $dp,
                0
            );

            /*
            |--------------------------------------------------------------------------
            | TOTAL BAYAR
            |--------------------------------------------------------------------------
            |
            | harga_final + denda
            |
            */

            $totalBayar =
                $hargaFinal + $denda;

            /*
            |--------------------------------------------------------------------------
            | UPDATE PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $pembayaran->update([
                'sisa_pembayaran' =>
                $sisaPembayaran,

                'denda' =>
                $denda,

                'total_bayar' =>
                $totalBayar,

                'status_pembayaran' =>
                Pembayaran::STATUS_LUNAS,
            ]);
        });

        return redirect()
            ->route('admin.pembayaran.index')
            ->with(
                'success',
                'Denda berhasil ditambahkan dan total pembayaran diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DENDA - EDIT
    |--------------------------------------------------------------------------
    */

    public function editDenda(Pembayaran $pembayaran)
    {
        if (
            $pembayaran->status_pembayaran
            !== Pembayaran::STATUS_LUNAS
        ) {
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


    /*
    |--------------------------------------------------------------------------
    | DENDA - UPDATE
    |--------------------------------------------------------------------------
    */

    public function updateDenda(
        Request $request,
        Pembayaran $pembayaran
    ) {
        if (
            $pembayaran->status_pembayaran
            !== Pembayaran::STATUS_LUNAS
        ) {
            abort(
                403,
                'Denda hanya dapat diperbarui pada pembayaran yang sudah lunas.'
            );
        }

        $validated = $request->validate([
            'denda' => [
                'required',
                'numeric',
                'min:1',
            ],
        ], [
            'denda.required' =>
            'Nominal denda wajib diisi.',

            'denda.numeric' =>
            'Nominal denda harus berupa angka.',

            'denda.min' =>
            'Nominal denda harus lebih dari Rp 0.',
        ]);

        DB::transaction(function () use (
            $validated,
            $pembayaran
        ) {

            $hargaFinal =
                (float) $pembayaran->harga_final;

            $dp =
                (float) $pembayaran->dp;

            $denda =
                (float) $validated['denda'];

            /*
            |--------------------------------------------------------------------------
            | SISA PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $sisaPembayaran = max(
                $hargaFinal - $dp,
                0
            );

            /*
            |--------------------------------------------------------------------------
            | TOTAL BAYAR
            |--------------------------------------------------------------------------
            */

            $totalBayar =
                $hargaFinal + $denda;

            /*
            |--------------------------------------------------------------------------
            | UPDATE PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $pembayaran->update([
                'sisa_pembayaran' =>
                $sisaPembayaran,

                'denda' =>
                $denda,

                'total_bayar' =>
                $totalBayar,

                'status_pembayaran' =>
                Pembayaran::STATUS_LUNAS,
            ]);
        });

        return redirect()
            ->route('admin.pembayaran.index')
            ->with(
                'success',
                'Denda berhasil diperbarui dan total pembayaran dihitung ulang.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER - STATUS PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    private function determinePaymentStatus(
        float $dp,
        float $hargaFinal
    ): string {

        /*
        |--------------------------------------------------------------------------
        | HARGA FINAL 0
        |--------------------------------------------------------------------------
        |
        | Jika harga final Rp0 karena diskon penuh,
        | transaksi dianggap lunas.
        |
        */

        if ($hargaFinal <= 0) {
            return Pembayaran::STATUS_LUNAS;
        }

        /*
        |--------------------------------------------------------------------------
        | BELUM BAYAR
        |--------------------------------------------------------------------------
        */

        if ($dp <= 0) {
            return Pembayaran::STATUS_BELUM_BAYAR;
        }

        /*
        |--------------------------------------------------------------------------
        | LUNAS
        |--------------------------------------------------------------------------
        */

        if ($dp >= $hargaFinal) {
            return Pembayaran::STATUS_LUNAS;
        }

        /*
        |--------------------------------------------------------------------------
        | DP
        |--------------------------------------------------------------------------
        */

        return Pembayaran::STATUS_DP;
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER - STATUS RESERVASI
    |--------------------------------------------------------------------------
    */

    private function determineReservationStatus(
        string $statusPembayaran
    ): string {

        return match ($statusPembayaran) {

            Pembayaran::STATUS_LUNAS =>
            Reservasi::STATUS_CONFIRMED,

            Pembayaran::STATUS_DP =>
            Reservasi::STATUS_PROCESS,

            Pembayaran::STATUS_BELUM_BAYAR =>
            Reservasi::STATUS_PENDING,

            default =>
            Reservasi::STATUS_PENDING,
        };
    }
}
