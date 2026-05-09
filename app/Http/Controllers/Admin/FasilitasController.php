<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->get();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => [
                'required',
                'string',
                'max:255',
                'unique:fasilitas,nama_fasilitas'
            ]
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'nama_fasilitas.unique' => 'Fasilitas sudah tersedia.'
        ]);

        try {

            Fasilitas::create([
                'nama_fasilitas' => trim(
                    ucwords(strtolower($validated['nama_fasilitas']))
                )
            ]);

            return redirect()
                ->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil ditambahkan');
        } catch (QueryException $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'nama_fasilitas' => 'Fasilitas sudah tersedia.'
                ]);
        }
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validated = $request->validate([
            'nama_fasilitas' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fasilitas', 'nama_fasilitas')
                    ->ignore($fasilitas->id)
            ]
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'nama_fasilitas.unique' => 'Fasilitas sudah tersedia.'
        ]);

        try {

            $fasilitas->update([
                'nama_fasilitas' => trim(
                    ucwords(strtolower($validated['nama_fasilitas']))
                )
            ]);

            return redirect()
                ->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil diperbarui');
        } catch (QueryException $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'nama_fasilitas' => 'Fasilitas sudah tersedia.'
                ]);
        }
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return back()->with(
            'success',
            'Fasilitas berhasil dihapus'
        );
    }
}
