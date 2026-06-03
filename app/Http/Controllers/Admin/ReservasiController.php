<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $reservasis = Reservasi::query()
            ->with([
                'pelanggan',
                'armada',
                'pembayaran'
            ])
            ->latest('id_reservasi')
            ->paginate(10);

        return view(
            'admin.reservasi.index',
            compact('reservasis')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Reservasi $reservasi)
    {
        $reservasi->load([
            'pelanggan',
            'armada',
            'pembayaran'
        ]);

        return view(
            'admin.reservasi.show',
            compact('reservasi')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        Reservasi $reservasi
    ) {
        $validated = $request->validate([
            'status_reservasi' => [
                'required',
                'in:' . implode(',', Reservasi::statusOptions())
            ]
        ]);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI FINAL STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $reservasi->isConfirmed()
            || $reservasi->isCancelled()
        ) {
            return back()->with(
                'error',
                'Status reservasi sudah final.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $reservasi->update([
            'status_reservasi' =>
            $validated['status_reservasi']
        ]);

        return back()->with(
            'success',
            'Status reservasi berhasil diperbarui.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Reservasi $reservasi)
    {
        /*
        |--------------------------------------------------------------------------
        | CEGAH HAPUS JIKA SUDAH ADA PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        if ($reservasi->pembayaran) {

            return back()->with(
                'error',
                'Reservasi yang memiliki pembayaran tidak dapat dihapus.'
            );
        }

        $reservasi->delete();

        return redirect()
            ->route('admin.reservasi.index')
            ->with(
                'success',
                'Reservasi berhasil dihapus.'
            );
    }
}
