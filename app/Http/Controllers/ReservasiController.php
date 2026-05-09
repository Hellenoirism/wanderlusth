<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Form booking (user pilih armada + isi sendiri)
     */
    public function create(Request $request)
    {
        $armada = null;

        if ($request->armada) {
            $armada = Armada::with('fasilitas')
                ->where('id_armada', $request->armada)
                ->first();
        }

        return view('reservasi.create', compact('armada'));
    }

    /**
     * Simpan reservasi (flow baru)
     */
    public function store(Request $request)
    {
        // Validasi Data

        $validated = $request->validate([
            'armada_id' => 'required|exists:armadas,id_armada',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',

            'tanggal_reservasi' => 'required|date|after_or_equal:today',
            'waktu' => 'required',
            'tujuan' => 'required|string|max:255',
            'jumlah_penumpang' => 'required|integer|min:1',
        ]);

        // Ambil data armada
        $armada = Armada::where('id_armada', $request->armada_id)->firstOrFail();

        // Validasi Kapasitas
        if ($request->jumlah_penumpang > $armada->kapasitas) {
            return back()->withErrors([
                'jumlah_penumpang' => 'Jumlah penumpang melebihi kapasitas armada'
            ])->withInput();
        }

        // Doble Book Checking
        $isBooked = Reservasi::where('id_armada', $armada->id_armada)
            ->where('tanggal_reservasi', $request->tanggal_reservasi)
            ->where('waktu', $request->waktu)
            ->exists();

        if ($isBooked) {
            return back()->withErrors([
                'tanggal_reservasi' => 'Armada sudah dibooking pada waktu tersebut'
            ])->withInput();
        }

        // Simpan pelanggan
        $pelanggan = Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        // Simpan Reservasi
        $reservasi = Reservasi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_armada' => $armada->id_armada,
            'waktu' => $request->waktu,
            'tujuan' => $request->tujuan,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'status_reservasi' => 'Pending',
            'tanggal_reservasi' => $request->tanggal_reservasi,
        ]);

        return redirect()->route('reservasi.success', $reservasi->id_reservasi);
    }

    /**
     * Halaman sukses
     */
    public function success(Reservasi $reservasi)
    {
        $reservasi->load([
            'pelanggan',
            'armada'
        ]);

        return view('reservasi.success', compact('reservasi'));
    }
}
