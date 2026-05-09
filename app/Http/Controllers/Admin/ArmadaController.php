<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    public function index()
    {
        $armadas = Armada::orderBy('created_at', 'desc')->get();
        
        return view('admin.armada.index', compact('armadas'));
    }

    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.armada.create', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required|unique:armadas',
            'kapasitas' => 'required|integer',
            'harga_sewa' => 'required|numeric',
            'fasilitas' => 'nullable|array'
        ]);

        $armada = Armada::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'kapasitas' => $request->kapasitas,
            'harga_sewa' => $request->harga_sewa,
        ]);
        if ($request->fasilitas) {
            $armada->fasilitas()->attach($request->fasilitas);
        }

        return redirect()->route('admin.armada.index')->with('success', 'Armada ditambahkan');
    }

    public function edit(Armada $armada)
    {
        $fasilitas = Fasilitas::all();
        $armada->load('fasilitas');
        return view('admin.armada.edit', compact('armada', 'fasilitas'));
    }

    public function update(Request $request, Armada $armada)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required|unique:armadas,plat_nomor,' . $armada->id_armada . ',id_armada',
            'kapasitas' => 'required|integer',
            'harga_sewa' => 'required|numeric',
            'fasilitas' => 'nullable|array'
        ]);

        $armada->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'kapasitas' => $request->kapasitas,
            'harga_sewa' => $request->harga_sewa,
        ]);
        
        $armada->fasilitas()->sync($request->fasilitas ?? []);

        return redirect()->route('admin.armada.index')->with('success', 'Armada diperbarui');
    }

    public function destroy(Armada $armada)
    {
        $armada->delete();
        return back()->with('success', 'Armada dihapus');
    }
}
