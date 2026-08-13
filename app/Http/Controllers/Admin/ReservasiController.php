<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Armada;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    | FUNGSI SHOW
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
    | FUNGSI STORE & CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();

        $armadas = Armada::orderBy('jenis_kendaraan')->get();

        return view(
            'admin.reservasi.create',
            compact(
                'pelanggans',
                'armadas'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan'      => 'required|string|max:255',
            'alamat'              => 'required|string',
            'no_hp'               => 'required|string|max:20',

            'id_armada'           => 'required|exists:armadas,id_armada',

            'tujuan'              => 'required|string|max:255',

            'tanggal_reservasi'   => 'required|date',

            'waktu'               => 'required',

            'jumlah_penumpang'    => 'required|integer|min:1',
        ]);

        // Ambil data armada untuk validasi kapasitas
        $armada = Armada::findOrFail($validated['id_armada']);

        // Validasi kapasitas penumpang
        if ($validated['jumlah_penumpang'] > $armada->kapasitas) {
            return back()->withErrors([
                'jumlah_penumpang' => 'Jumlah penumpang melebihi kapasitas armada (Kapasitas: ' . $armada->kapasitas . ')'
            ])->withInput();
        }

        // Validasi double-booking
        $isBooked = Reservasi::where('id_armada', $validated['id_armada'])
            ->where('tanggal_reservasi', $validated['tanggal_reservasi'])
            ->where('waktu', $validated['waktu'])
            ->exists();

        if ($isBooked) {
            return back()->withErrors([
                'tanggal_reservasi' => 'Armada sudah dibooking pada waktu tersebut'
            ])->withInput();
        }

        DB::transaction(function () use ($validated) {

            $pelanggan = Pelanggan::create([
                'nama'    => $validated['nama_pelanggan'],
                'alamat'  => $validated['alamat'],
                'no_hp'   => $validated['no_hp'],
            ]);

            Reservasi::create([
                'id_pelanggan'      => $pelanggan->id_pelanggan,
                'id_armada'         => $validated['id_armada'],
                'tujuan'            => $validated['tujuan'],
                'tanggal_reservasi' => $validated['tanggal_reservasi'],
                'waktu'             => $validated['waktu'],
                'jumlah_penumpang'  => $validated['jumlah_penumpang'],
                'status_reservasi'  => Reservasi::STATUS_PENDING,
            ]);
        });

        return redirect()
            ->route('admin.reservasi.index')
            ->with('success', 'Reservasi berhasil ditambahkan.');
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
        | VALIDASI STATUS TRANSITION
        |--------------------------------------------------------------------------
        */

        $newStatus = $validated['status_reservasi'];
        $currentStatus = $reservasi->status_reservasi;
        
        // Validasi transisi status yang diizinkan
        $validTransitions = [
            Reservasi::STATUS_PENDING => [
                Reservasi::STATUS_PROCESS,
                Reservasi::STATUS_CANCELLED,
            ],
            Reservasi::STATUS_PROCESS => [
                Reservasi::STATUS_CONFIRMED,
                Reservasi::STATUS_CANCELLED,
            ],
        ];

        if (!isset($validTransitions[$currentStatus]) || !in_array($newStatus, $validTransitions[$currentStatus])) {
            return back()->with(
                'error',
                'Transisi status tidak diizinkan dari ' . $currentStatus . ' ke ' . $newStatus
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
