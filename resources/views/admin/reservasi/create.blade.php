@extends('admin.layouts.app')

@section('title', 'Input Reservasi')
@section('page-title', 'Input Reservasi Manual')

@section('content')
<div class="max-w-2xl mx-auto text-gray-800">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Input Reservasi</h2>
            <p class="text-sm text-gray-500">Tambahkan reservasi secara manual</p>
        </div>

        <form action="{{ route('admin.reservasi.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Pelanggan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Pelanggan
                </label>
                <select name="pelanggan_id"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $p)
                        <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Tanggal Reservasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Tanggal Reservasi
                    </label>
                    <input type="date"
                           name="tanggal_reservasi"
                           value="{{ old('tanggal_reservasi') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    @error('tanggal_reservasi')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah Penumpang --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Jumlah Penumpang
                    </label>
                    <input type="number"
                           name="jumlah_penumpang"
                           value="{{ old('jumlah_penumpang') }}"
                           min="1"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                           placeholder="Contoh: 10">
                    @error('jumlah_penumpang')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Action --}}
            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('admin.reservasi.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700 transition">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl shadow hover:bg-indigo-700 transition">
                    Simpan Reservasi
                </button>

            </div>

        </form>

    </div>

</div>
@endsection