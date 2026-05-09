@extends('admin.layouts.app')

@section('title', 'Tambah Armada')
@section('page-title', 'Tambah Armada')

@section('content')
<div class="max-w-2xl mx-auto text-gray-800">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Armada</h2>
            <p class="text-sm text-gray-500">Tambahkan data armada baru</p>
        </div>

        <form action="{{ route('admin.armada.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Jenis Kendaraan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Merk Kendaraan
                </label>
                <input
                    type="text"
                    name="jenis_kendaraan"
                    value="{{ old('jenis_kendaraan') }}"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Contoh: Mercedez"
                >
                @error('jenis_kendaraan')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Plat Nomor --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Plat Nomor
                </label>
                <input
                    type="text"
                    name="plat_nomor"
                    value="{{ old('plat_nomor') }}"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="B 1234 ABC"
                >
                @error('plat_nomor')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grid Kapasitas & Harga --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Kapasitas
                    </label>
                    <input
                        type="number"
                        name="kapasitas"
                        value="{{ old('kapasitas') }}"
                        min="1"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        placeholder="40"
                    >
                    @error('kapasitas')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Harga Sewa (Rp)
                    </label>
                    <input
                        type="number"
                        name="harga_sewa"
                        value="{{ old('harga_sewa') }}"
                        min="0"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        placeholder="1500000"
                    >
                    @error('harga_sewa')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- FASILITAS --}}
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Fasilitas
    </label>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        @foreach ($fasilitas as $item)
            <label class="flex items-center gap-2 bg-gray-50 border rounded-lg px-3 py-2 cursor-pointer hover:bg-indigo-50 transition">
                <input 
                    type="checkbox" 
                    name="fasilitas[]" 
                    value="{{ $item->id }}"
                    class="rounded text-indigo-600 focus:ring-indigo-500"
                    {{ in_array($item->id, old('fasilitas', [])) ? 'checked' : '' }}
                >
                <span class="text-sm text-gray-700">
                    {{ $item->nama_fasilitas }}
                </span>
            </label>
        @endforeach
    </div>

    @error('fasilitas')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

            </div>

            {{-- Action --}}
            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('admin.armada.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700 transition">
                    ← Kembali
                </a>

                <button
                    type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl shadow hover:bg-indigo-700 transition">
                    Simpan Armada
                </button>

            </div>

        </form>

    </div>

</div>
@endsection