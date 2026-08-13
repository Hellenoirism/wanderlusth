@extends('admin.layouts.app')

@section('title', 'Edit Pembayaran')
@section('page-title', 'Edit Pembayaran')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="rounded-3xl border border-slate-200 bg-white shadow-xl">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="border-b border-slate-200 px-8 py-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Edit Pembayaran
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui nominal pembayaran dan metode pembayaran
            </p>

        </div>


        <div class="p-8">

            {{-- =========================================================
                VALIDATION ERROR
            ========================================================== --}}
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


            {{-- =========================================================
                INFO RESERVASI
            ========================================================== --}}
            <div class="mb-8 rounded-2xl border border-slate-200 bg-slate-50 p-6">

                <div class="mb-5 flex items-center justify-between">

                    <div>

                        <p class="text-xs uppercase tracking-wide text-slate-500">
                            ID Reservasi
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-indigo-600">
                            #RES-{{ str_pad(
                                $pembayaran->reservasi->id_reservasi,
                                4,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </h3>

                    </div>


                    {{-- STATUS PEMBAYARAN --}}
                    <span
                        @class([
                            'inline-flex items-center rounded-full px-4 py-2 text-xs font-bold',

                            'bg-slate-100 text-slate-700'
                                => $pembayaran->status_pembayaran === 'Belum Bayar',

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


                    {{-- HARGA AWAL --}}
                    <div>

                        <p class="text-xs text-slate-500">
                            Harga Awal
                        </p>

                        <p
                            class="mt-1 font-semibold text-slate-800"
                            data-currency-text="{{ $pembayaran->harga_awal }}"
                        ></p>

                    </div>


                    {{-- HARGA FINAL --}}
                    <div>

                        <p class="text-xs text-slate-500">
                            Harga Final
                        </p>

                        <p
                            class="mt-1 font-semibold text-indigo-600"
                            data-currency-text="{{ $pembayaran->harga_final }}"
                        ></p>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                FORM
            ========================================================== --}}
            <form
                action="{{ route('admin.pembayaran.update', $pembayaran) }}"
                method="POST"
                class="space-y-6"
            >

                @csrf
                @method('PUT')


                {{-- =====================================================
                    NOMINAL PEMBAYARAN
                ====================================================== --}}
                <div>

                    <label
                        for="dp_display"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nominal Pembayaran
                    </label>

                    <p class="mb-2 text-xs text-slate-500">
                        Nominal pembayaran tidak boleh melebihi harga final.
                    </p>


                    {{-- DISPLAY RUPIAH --}}
                    <input
                        type="text"
                        id="dp_display"
                        placeholder="Rp 0"
                        data-currency
                        data-target="dp"
                        value="{{ old('dp', $pembayaran->dp) }}"
                        required
                        autocomplete="off"
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


                    {{-- RAW VALUE UNTUK SERVER --}}
                    <input
                        type="hidden"
                        name="dp"
                        id="dp"
                        value="{{ old('dp', $pembayaran->dp) }}"
                    >


                    @error('dp')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- =====================================================
                    METODE PEMBAYARAN
                ====================================================== --}}
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
                            w-full
                            rounded-2xl
                            border
                            border-slate-300
                            bg-white
                            px-4
                            py-3
                            text-sm
                            font-medium
                            text-slate-800
                            shadow-sm
                            transition
                            focus:border-indigo-500
                            focus:outline-none
                            focus:ring-4
                            focus:ring-indigo-100
                        "
                    >

                        <option
                            value="Transfer Bank"
                            @selected(
                                old(
                                    'metode_pembayaran',
                                    $pembayaran->metode_pembayaran
                                ) === 'Transfer Bank'
                            )
                        >
                            Transfer Bank
                        </option>

                        <option
                            value="Cash"
                            @selected(
                                old(
                                    'metode_pembayaran',
                                    $pembayaran->metode_pembayaran
                                ) === 'Cash'
                            )
                        >
                            Cash
                        </option>

                        <option
                            value="QRIS"
                            @selected(
                                old(
                                    'metode_pembayaran',
                                    $pembayaran->metode_pembayaran
                                ) === 'QRIS'
                            )
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


                {{-- =====================================================
                    INFORMASI
                ====================================================== --}}
                <div class="rounded-2xl border border-blue-200 bg-blue-50 p-4">

                    <div class="flex gap-3">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mt-0.5 h-5 w-5 shrink-0 text-blue-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"
                            />
                        </svg>

                        <div>

                            <p class="text-sm font-semibold text-blue-700">
                                Informasi Pembayaran
                            </p>

                            <p class="mt-1 text-xs leading-relaxed text-blue-600">
                                Status pembayaran dan sisa pembayaran akan
                                dihitung otomatis oleh sistem berdasarkan
                                nominal pembayaran dan harga final.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    ACTION
                ====================================================== --}}
                <div class="flex items-center justify-between border-t border-slate-200 pt-6">

                    <a
                        href="{{ route('admin.pembayaran.index') }}"
                        class="
                            text-sm
                            font-medium
                            text-slate-500
                            transition
                            hover:text-slate-700
                        "
                    >
                        ← Kembali
                    </a>


                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            rounded-2xl
                            bg-indigo-600
                            px-6
                            py-3
                            text-sm
                            font-semibold
                            text-white
                            shadow-lg
                            shadow-indigo-500/20
                            transition
                            hover:bg-indigo-700
                            focus:outline-none
                            focus:ring-4
                            focus:ring-indigo-200
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