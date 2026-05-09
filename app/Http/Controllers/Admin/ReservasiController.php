<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /*
      List semua reservasi
     */
    public function index()
    {
        
        $reservasis = Reservasi::with(['pelanggan', 'armada'])
            ->latest()
            ->get();

        return view('admin.reservasi.index', compact('reservasis'));
    }

    /*
      Detail reservasi
     */
    public function show(Reservasi $reservasi)
    {
        $reservasi->load(['pelanggan', 'armada']);

        return view('admin.reservasi.show', compact('reservasi'));
    }

    /*
      Update status (approve / cancel)
     */
    public function updateStatus(Request $request, Reservasi $reservasi)
    {
        $validated = $request->validate([
            'status_reservasi' => 'required|in:pending,dikonfirmasi,dibatalkan'
        ]);

        // prevent update kalau sudah final
        if (in_array($reservasi->status_reservasi, ['dikonfirmasi', 'dibatalkan'])) {
            return back()->with('error', 'Status sudah final, tidak bisa diubah');
        }

        $reservasi->update([
            'status_reservasi' => $validated['status_reservasi']
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    /*
     Hapus reservasi
     */
    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();

        return redirect()
            ->route('admin.reservasi.index')
            ->with('success', 'Reservasi berhasil dihapus');
    }
}
