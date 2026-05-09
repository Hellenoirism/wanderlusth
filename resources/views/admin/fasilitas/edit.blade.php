@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas')
@section('page-title', 'Edit Fasilitas')

@section('content')
<div class="max-w-2xl mx-auto text-gray-800">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

        <div class="mb-6">
            <h2 class="text-2xl font-bold">Edit Fasilitas</h2>
            <p class="text-sm text-gray-500">Perbarui fasilitas</p>
        </div>

        <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1">Nama Fasilitas</label>
                <input type="text"
                       name="nama_fasilitas"
                       value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}"
                       class="w-full rounded-xl border-gray-300 focus:ring-indigo-500">

                @error('nama_fasilitas')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.fasilitas.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                    Update
                </button>
            </div>

        </form>

    </div>

</div>
@endsection