@extends('admin.layouts.app')

@section('title', 'Input Pembayaran')
@section('page-title', 'Input Pembayaran')

@section('content')

<div class="max-w-4xl mx-auto text-gray-800">

    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-lg">

        {{-- HEADER --}}
        <div class="mb-8">

            <h2 class="text-2xl font-bold text-slate-800">
                Input Pembayaran
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan transaksi pembayaran reservasi pelanggan
            </p>

        </div>

        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-100 px-4 py-3 text-sm text-green-700">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERROR --}}
        @if(session('error'))

            <div class="mb-6 rounded-xl border border-red-200 bg-red-100 px-4 py-3 text-sm text-red-700">

                {{ session('error') }}

            </div>

        @endif

        {{-- VALIDATION ERROR --}}
        @if($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-100 px-4 py-4">

                <div class="mb-2 text-sm font-semibold text-red-700">
                    Terjadi kesalahan validasi:
                </div>

                <ul class="space-y-1 text-sm text-red-700">

                    @foreach($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORM --}}
        <form
            action="{{ route('admin.pembayaran.store') }}"
            method="POST"
            class="space-y-8"
        >

            @csrf

            <input
                type="hidden"
                name="id_reservasi"
                value="{{ $reservasi->id_reservasi }}"
            >

            {{-- DETAIL RESERVASI --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">

                <div class="mb-6 flex items-start justify-between">

                    <div>

                        <p class="text-xs text-slate-500">
                            ID Reservasi
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                            #RES-{{ str_pad($reservasi->id_reservasi, 4, '0', STR_PAD_LEFT) }}
                        </h3>

                    </div>

                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $reservasi->status_badge }}">

                        {{ $reservasi->status_label }}

                    </span>

                </div>

                <div class="grid grid-cols-1 gap-5 text-sm md:grid-cols-2">

                    <div>

                        <p class="mb-1 text-slate-500">
                            Pelanggan
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ optional($reservasi->pelanggan)->nama ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="mb-1 text-slate-500">
                            No HP
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ optional($reservasi->pelanggan)->no_hp ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="mb-1 text-slate-500">
                            Armada
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ optional($reservasi->armada)->jenis_kendaraan ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="mb-1 text-slate-500">
                            Jumlah Penumpang
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $reservasi->jumlah_penumpang ?? 0 }} Orang
                        </p>

                    </div>

                    <div>

                        <p class="mb-1 text-slate-500">
                            Tanggal Reservasi
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $reservasi->formatted_tanggal }}
                        </p>

                    </div>

                    <div>

                        <p class="mb-1 text-slate-500">
                            Waktu
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $reservasi->formatted_waktu }}
                        </p>

                    </div>

                    <div class="md:col-span-2">

                        <p class="mb-1 text-slate-500">
                            Tujuan
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $reservasi->tujuan ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- FORM INPUT --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- JENIS PEMBAYARAN --}}
                <div class="md:col-span-2">

                    <label
                        for="jenis_pembayaran"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Jenis Pembayaran
                    </label>

                    <select
                        name="jenis_pembayaran"
                        id="jenis_pembayaran"
                        required
                        class="
                            w-full rounded-xl border-slate-300
                            focus:border-indigo-500
                            focus:ring-indigo-500
                        "
                    >

                        <option value="">
                            -- Pilih Jenis Pembayaran --
                        </option>

                        <option
                            value="DP"
                            @selected(old('jenis_pembayaran') === 'DP')
                        >
                            DP
                        </option>

                        <option
                            value="Lunas"
                            @selected(old('jenis_pembayaran') === 'Lunas')
                        >
                            Lunas
                        </option>

                    </select>

                    @error('jenis_pembayaran')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- HARGA AWAL --}}
                <div>

                    <label
                        for="harga_awal_display"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Harga Awal
                    </label>

                    <input
    type="text"
    id="harga_awal_display"
    value="{{ old('harga_awal', $defaultHargaAwal) }}"
    readonly
    data-currency
    data-target="harga_awal"
    class="
        w-full rounded-xl border border-slate-300
        bg-slate-100 px-4 py-3
        text-slate-800
    "
>

<input
    type="hidden"
    name="harga_awal"
    id="harga_awal"
    value="{{ old('harga_awal', $defaultHargaAwal) }}"
>

                    <p class="mt-2 text-xs text-slate-500">
                        Harga awal otomatis diambil dari data armada
                    </p>

                </div>

                {{-- HARGA FINAL --}}
                <div>

                    <label
                        for="harga_final_display"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Harga Final
                    </label>

                    <input
    type="text"
    id="harga_final_display"
    value="{{ old('harga_final', $defaultHargaAwal) }}"
    placeholder="Rp 0"
    data-currency
    data-target="harga_final"
    class="
        w-full rounded-xl border border-slate-300
        bg-white px-4 py-3
        text-slate-800
        focus:border-indigo-500
        focus:ring-indigo-500
    "
>

<input
    type="hidden"
    name="harga_final"
    id="harga_final"
    value="{{ old('harga_final', $defaultHargaAwal) }}"
>

                    @error('harga_final')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- DP --}}
                <div id="dp_wrapper">

                    <label
                        for="dp_display"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nominal DP
                    </label>

                    <input
                    type="text"
                    id="dp_display"
                    value="{{ old('dp') }}"
                    placeholder="Rp 0"
                    data-currency
                    data-target="dp"
                    class="
                        w-full rounded-xl border border-slate-300
                        bg-white px-4 py-3
                        text-slate-800
                        focus:border-indigo-500
                        focus:ring-indigo-500
                    "
                >
                
                <input
                    type="hidden"
                    name="dp"
                    id="dp"
                    value="{{ old('dp') }}"
                >

                    <p class="mt-2 text-xs text-slate-500">
                        Isi DP jika pembayaran belum lunas
                    </p>

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
                            w-full rounded-xl border-slate-300
                            focus:border-indigo-500
                            focus:ring-indigo-500
                        "
                    >

                        <option value="">
                            -- Pilih Metode --
                        </option>

                        <option
                            value="Transfer Bank"
                            @selected(old('metode_pembayaran') === 'Transfer Bank')
                        >
                            Transfer Bank
                        </option>

                        <option
                            value="Cash"
                            @selected(old('metode_pembayaran') === 'Cash')
                        >
                            Cash
                        </option>

                        <option
                            value="QRIS"
                            @selected(old('metode_pembayaran') === 'QRIS')
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

            </div>

            {{-- FLOW INFO --}}
            <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">

                <h4 class="mb-3 text-sm font-semibold text-blue-800">
                    Flow Status Otomatis
                </h4>

                <ul class="space-y-2 text-sm text-blue-700">

                    <li>
                        • Pembayaran DP → Status Reservasi menjadi Diproses
                    </li>

                    <li>
                        • Pembayaran Lunas → Status Reservasi menjadi Dikonfirmasi
                    </li>

                    <li>
                        • Status pembayaran akan diatur otomatis oleh sistem
                    </li>

                </ul>

            </div>

            {{-- ACTION --}}
            <div class="flex items-center justify-between pt-2">

                <a
                    href="{{ route('admin.pembayaran.index') }}"
                    class="text-sm text-slate-500 transition hover:text-slate-700"
                >
                    ← Kembali
                </a>

                <button
                    type="submit"
                    class="
                        inline-flex items-center rounded-xl
                        bg-indigo-600 px-6 py-3
                        font-medium text-white
                        transition hover:bg-indigo-700
                    "
                >

                    Simpan Pembayaran

                </button>

            </div>

        </form>

    </div>

</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const jenisPembayaran =
        document.getElementById('jenis_pembayaran');

    const dpWrapper =
        document.getElementById('dp_wrapper');

    const dpDisplay =
        document.getElementById('dp_display');

    const dpHidden =
        document.getElementById('dp');

    function toggleDPField() {

        const isLunas =
            jenisPembayaran.value === 'Lunas';

        if (isLunas) {

            dpDisplay.value = '';
            dpHidden.value = '';

            dpDisplay.readOnly = true;

            dpWrapper.classList.add(
                'opacity-60',
                'pointer-events-none'
            );

        } else {

            dpDisplay.readOnly = false;

            dpWrapper.classList.remove(
                'opacity-60',
                'pointer-events-none'
            );
        }
    }

    toggleDPField();

    jenisPembayaran.addEventListener(
        'change',
        toggleDPField
    );
});
</script>
@endpush

@endsection