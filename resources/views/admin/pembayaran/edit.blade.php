@extends('admin.layouts.app')

@section('title', 'Edit Pembayaran')
@section('page-title', 'Edit Pembayaran')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="rounded-3xl border border-slate-200 bg-white shadow-xl">

        {{-- HEADER --}}
        <div class="border-b border-slate-200 px-8 py-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Edit Pembayaran
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Update pembayaran atau lakukan pelunasan pembayaran DP
            </p>

        </div>

        <div class="p-8">

            {{-- VALIDATION ERROR --}}
            @if($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                    <div class="mb-2 flex items-center gap-2">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-red-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                            />

                        </svg>

                        <h4 class="font-semibold text-red-700">
                            Terjadi kesalahan validasi
                        </h4>

                    </div>

                    <ul class="space-y-1 text-sm text-red-600">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- INFO RESERVASI --}}
            <div class="mb-8 rounded-2xl border border-slate-200 bg-slate-50 p-6">

                <div class="mb-5 flex items-center justify-between">

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            ID Reservasi
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-indigo-600">
                            #RES-{{ str_pad($pembayaran->reservasi->id_reservasi, 4, '0', STR_PAD_LEFT) }}
                        </h3>

                    </div>

                    <span
                        @class([
                            'inline-flex items-center rounded-full px-4 py-2 text-xs font-bold',

                            'bg-yellow-100 text-yellow-700'
                                => $pembayaran->status_pembayaran === 'DP',

                            'bg-green-100 text-green-700'
                                => $pembayaran->status_pembayaran === 'Lunas',
                        ])
                    >

                        {{ $pembayaran->status_pembayaran }}

                    </span>

                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- PELANGGAN --}}
                    <div>

                        <p class="text-xs text-slate-500">
                            Pelanggan
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pembayaran->reservasi->pelanggan?->nama ?? '-' }}
                        </p>

                    </div>

                    {{-- ARMADA --}}
                    <div>

                        <p class="text-xs text-slate-500">
                            Armada
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pembayaran->reservasi->armada?->jenis_kendaraan ?? '-' }}
                        </p>

                    </div>

                    {{-- HARGA FINAL --}}
                    <div>

                        <p class="text-xs text-slate-500">
                            Harga Final
                        </p>

                        <p
                            class="mt-1 font-semibold text-slate-800"
                            data-currency-text="{{ $pembayaran->harga_final }}"
                        >
                        </p>

                    </div>

                    {{-- SISA PEMBAYARAN --}}
                    <div>

                        <p class="text-xs text-slate-500">
                            Sisa Pembayaran
                        </p>

                        <p
                            class="mt-1 font-semibold text-red-600"
                            data-currency-text="{{ $pembayaran->sisa_pembayaran }}"
                        >
                        </p>

                    </div>

                </div>

            </div>

            {{-- FORM --}}
            <form
                action="{{ route('admin.pembayaran.update', $pembayaran) }}"
                method="POST"
                class="space-y-6"
            >

                @csrf
                @method('PUT')

                {{-- TOTAL BAYAR --}}
                <div>
                
                    <label
                        for="total_bayar_display"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Total Pembayaran
                    </label>
                
                    {{-- DISPLAY --}} 
                    <input
    type="text"
    id="total_bayar_display"
    placeholder="Rp 0"
    data-currency
    data-target="total_bayar"
    required
    class="
        w-full
        appearance-none
        rounded-2xl
        border
        border-slate-300
        bg-white
        px-4
        py-3
        text-sm
        font-medium
        text-slate-800
        placeholder:text-slate-400
        shadow-sm
        transition
        focus:border-indigo-500
        focus:outline-none
        focus:ring-4
        focus:ring-indigo-100
    "
>
                
                    {{-- RAW VALUE --}}
                    <input
                        type="hidden"
                        name="total_bayar"
                        id="total_bayar"
                        value="{{ old('total_bayar', $pembayaran->total_bayar) }}"
                    >
                
                    @error('total_bayar')
                
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                
                    @enderror
                
                </div>

                {{-- METODE PEMBAYARAN --}}
                <div>

                    <label
                        for="metode_pembayaran"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode_pembayaran"
                        id="metode_pembayaran"
                        required
                        class="
                            w-full rounded-2xl border border-slate-300
                            bg-white px-4 py-3
                            text-sm font-medium text-slate-800
                            shadow-sm transition
                            focus:border-indigo-500
                            focus:outline-none
                            focus:ring-4 focus:ring-indigo-100
                        "
                    >

                        <option
                            value="Transfer Bank"
                            @selected(old('metode_pembayaran', $pembayaran->metode_pembayaran) === 'Transfer Bank')
                        >
                            Transfer Bank
                        </option>

                        <option
                            value="Cash"
                            @selected(old('metode_pembayaran', $pembayaran->metode_pembayaran) === 'Cash')
                        >
                            Cash
                        </option>

                        <option
                            value="QRIS"
                            @selected(old('metode_pembayaran', $pembayaran->metode_pembayaran) === 'QRIS')
                        >
                            QRIS
                        </option>

                    </select>

                    @error('metode_pembayaran')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- ACTION --}}
                <div class="flex items-center justify-between border-t border-slate-200 pt-6">

                    <a
                        href="{{ route('admin.pembayaran.index') }}"
                        class="text-sm font-medium text-slate-500 transition hover:text-slate-700"
                    >
                        ← Kembali
                    </a>

                    <button
                        type="submit"
                        class="
                            inline-flex items-center rounded-2xl
                            bg-indigo-600 px-6 py-3
                            text-sm font-semibold text-white
                            shadow-lg shadow-indigo-500/20
                            transition hover:bg-indigo-700
                        "
                    >

                        Update Pembayaran

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection