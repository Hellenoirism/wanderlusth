<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Pelanggan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            'tanggal_reservasi' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addDays(90)->format('Y-m-d'),
            'waktu' => 'required',
            'tujuan' => 'required|string|max:255',
            'jumlah_penumpang' => 'required|integer|min:1',
        ],
        [
            'armada_id.required' => 'Silahkan pilih armada',
            'armada_id.exists' => ' Armada yang dipilih tidak ditemukan',
            'nama.required'=> 'Nama pelanggan wajib diisi',
            'nama.max' => 'Nama pelanggan maksimal 100 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
            'tanggal_reservasi.required' => 'Tanggal reservasi wajib diisi.',
            'tanggal_reservasi.after_or_equal' => 'Tanggal reservasi tidak boleh sebelum hari ini.',
            'tanggal_reservasi.before_or_equal' => 'Tanggal reservasi maksimal 90 hari ke depan.',
            'waktu.required' => 'Jam keberangkatan wajib dipilih.',
            'tujuan.required' => 'Tujuan perjalanan wajib diisi.',
            'jumlah_penumpang.required' => 'Jumlah penumpang wajib diisi.',
            'jumlah_penumpang.integer' => 'Jumlah penumpang harus berupa angka.',
            'jumlah_penumpang.min' => 'Jumlah penumpang minimal 1 orang.',
        ]
        );

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

        // Simpan dalam transaction untuk mencegah race condition
        $reservasi = DB::transaction(function () use ($request, $armada, $validated) {
            // Gunakan firstOrCreate untuk menghindari duplikasi pelanggan
            $pelanggan = Pelanggan::firstOrCreate(
                ['no_hp' => $validated['no_hp']],
                [
                    'nama' => $validated['nama'],
                    'alamat' => $validated['alamat'],
                ]
            );

            // Simpan Reservasi
            return Reservasi::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_armada' => $armada->id_armada,
                'waktu' => $request->waktu,
                'tujuan' => $request->tujuan,
                'jumlah_penumpang' => $request->jumlah_penumpang,
                'status_reservasi' => 'Pending',
                'tanggal_reservasi' => $request->tanggal_reservasi,
            ]);
        });

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
