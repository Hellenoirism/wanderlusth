@extends('admin.layouts.app')

@section('title', 'Edit Denda')
@section('page-title', 'Edit Denda')
@section('page-description', 'Perbarui nominal denda pada pembayaran reservasi')

@section('content')

<div class="space-y-6">
{{-- HEADER --}}
<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <h2 class="text-2xl font-bold text-white">
            Edit Denda
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            Perbarui nominal denda untuk reservasi yang telah lunas.
        </p>
    </div>

    <a
        href="{{ route('admin.pembayaran.index') }}"
        class="
            inline-flex items-center justify-center
            rounded-xl
            border border-slate-600
            bg-slate-800
            px-4 py-2.5
            text-sm font-semibold
            text-white
            transition
            hover:bg-slate-700
        "
    >
        ← Kembali
    </a>

</div>


{{-- FLASH MESSAGE --}}
@if(session('success'))

    <div
        class="
            flex items-start gap-3
            rounded-2xl
            border border-emerald-500/20
            bg-emerald-500/10
            px-5 py-4
            text-sm text-emerald-300
        "
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="mt-0.5 h-5 w-5 shrink-0"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"
            />
        </svg>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


{{-- VALIDATION ERROR --}}
@if ($errors->any())

    <div
        class="
            rounded-2xl
            border border-red-500/20
            bg-red-500/10
            px-5 py-4
            text-sm text-red-300
        "
    >

        <div class="flex items-start gap-3">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mt-0.5 h-5 w-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

            <div>

                <p class="font-semibold">
                    Terdapat kesalahan pada input:
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- MAIN CARD --}}
<div
    class="
        overflow-hidden
        rounded-3xl
        border border-slate-200
        bg-white
        shadow-xl
    "
>

    {{-- CARD HEADER --}}
    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

        <div class="flex items-center gap-3">

            <div
                class="
                    flex h-11 w-11
                    items-center justify-center
                    rounded-xl
                    bg-amber-100
                    text-amber-600
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 4h2m-1-1v2m-7.07 2.93l1.42 1.42M4 12h2m12 0h2m-2.93-4.07l1.42-1.42M12 18v2m-4.07-1.93l1.42-1.42M16.07 16.07l1.42 1.42M12 8a4 4 0 100 8 4 4 0 000-8z"
                    />
                </svg>

            </div>

            <div>

                <h3 class="text-lg font-bold text-slate-900">
                    Edit Detail Denda
                </h3>

                <p class="text-sm text-slate-500">
                    Perbarui nominal denda yang tercatat pada pembayaran ini.
                </p>

            </div>

        </div>

    </div>


    <div class="p-6">

        {{-- DETAIL RESERVASI --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            {{-- NOMOR RESERVASI --}}
            <div
                class="
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-5
                "
            >

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Nomor Reservasi
                </p>

                <p class="mt-2 text-lg font-bold text-indigo-600">
                    #RES-{{ str_pad(
                        $pembayaran->reservasi->id_reservasi,
                        4,
                        '0',
                        STR_PAD_LEFT
                    ) }}
                </p>

            </div>


            {{-- PELANGGAN --}}
            <div
                class="
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-5
                "
            >

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Pelanggan
                </p>

                <p class="mt-2 font-bold text-slate-900">
                    {{ $pembayaran->reservasi->pelanggan?->nama ?? '-' }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $pembayaran->reservasi->pelanggan?->no_hp ?? '-' }}
                </p>

            </div>


            {{-- ARMADA --}}
            <div
                class="
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-5
                "
            >

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Armada
                </p>

                <p class="mt-2 font-bold text-slate-900">
                    {{ $pembayaran->reservasi->armada?->jenis_kendaraan ?? '-' }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Kapasitas:
                    {{ $pembayaran->reservasi->armada?->kapasitas ?? '-' }}
                    Orang
                </p>

            </div>


            {{-- TUJUAN --}}
            <div
                class="
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-5
                "
            >

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Tujuan
                </p>

                <p class="mt-2 font-bold text-slate-900">
                    {{ $pembayaran->reservasi->tujuan ?? '-' }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $pembayaran->reservasi->formatted_tanggal ?? '-' }}
                    •
                    {{ $pembayaran->reservasi->formatted_waktu ?? '-' }}
                </p>

            </div>

        </div>


        {{-- PAYMENT SUMMARY --}}
        <div
            class="
                mt-6
                rounded-2xl
                border border-emerald-200
                bg-emerald-50
                p-5
            "
        >

            <div class="flex items-center justify-between gap-4">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                        Status Pembayaran
                    </p>

                    <p class="mt-1 text-lg font-bold text-emerald-800">
                        Lunas
                    </p>

                </div>

                <span
                    class="
                        inline-flex items-center
                        rounded-full
                        bg-emerald-100
                        px-4 py-2
                        text-xs font-bold
                        text-emerald-700
                    "
                >
                    Pembayaran Lunas
                </span>

            </div>


            <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-3">

                {{-- HARGA FINAL --}}
                <div>

                    <p class="text-xs text-slate-500">
                        Harga Final
                    </p>

                    <p class="mt-1 font-bold text-slate-900">
                        Rp {{ number_format(
                            $pembayaran->harga_final,
                            0,
                            ',',
                            '.'
                        ) }}
                    </p>

                </div>


                {{-- TOTAL BAYAR --}}
                <div>

                    <p class="text-xs text-slate-500">
                        Total Dibayar
                    </p>

                    <p class="mt-1 font-bold text-emerald-600">
                        Rp {{ number_format(
                            $pembayaran->total_bayar,
                            0,
                            ',',
                            '.'
                        ) }}
                    </p>

                </div>


                {{-- SISA PEMBAYARAN --}}
                <div>

                    <p class="text-xs text-slate-500">
                        Sisa Pembayaran
                    </p>

                    <p class="mt-1 font-bold text-red-500">
                        Rp {{ number_format(
                            $pembayaran->sisa_pembayaran,
                            0,
                            ',',
                            '.'
                        ) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- CURRENT DENDA --}}
        <div
            class="
                mt-6
                rounded-2xl
                border border-red-200
                bg-red-50
                p-6
            "
        >

            <div class="mb-5">

                <h3 class="text-lg font-bold text-slate-900">
                    Nominal Denda
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui nominal denda sesuai kondisi reservasi.
                </p>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route(
                    'admin.pembayaran.denda.update',
                    $pembayaran->id_pembayaran
                ) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                {{-- INPUT DENDA --}}
                <div>

                    <label
                        for="denda_display"
                        class="block text-sm font-semibold text-slate-700"
                    >
                        Denda <span class="text-red-500">*</span>
                    </label>


                    <div class="relative mt-2">

                        <span
                            class="
                                pointer-events-none
                                absolute inset-y-0 left-0
                                flex items-center
                                border-r border-slate-300
                                bg-slate-100
                                px-4
                                text-sm font-semibold
                                text-slate-600
                            "
                        >
                            Rp
                        </span>


                        <input
                            type="text"
                            id="denda_display"
                            inputmode="numeric"
                            autocomplete="off"
                            value="{{ old(
                                'denda',
                                $pembayaran->denda
                            )
                                ? number_format(
                                    old(
                                        'denda',
                                        $pembayaran->denda
                                    ),
                                    0,
                                    ',',
                                    '.'
                                )
                                : ''
                            }}"
                            placeholder="0"
                            class="
                                block w-full
                                rounded-xl
                                border border-slate-300
                                bg-white
                                py-3
                                pl-16 pr-4
                                text-right
                                text-lg
                                font-semibold
                                text-slate-900
                                outline-none
                                transition
                                focus:border-red-500
                                focus:ring-2
                                focus:ring-red-500/20
                            "
                        />


                        {{-- NILAI RAW --}}
                        <input
                            type="hidden"
                            name="denda"
                            id="denda"
                            value="{{ old(
                                'denda',
                                $pembayaran->denda
                            ) }}"
                        />

                    </div>


                    @error('denda')
                        <p class="mt-2 text-sm font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror


                    <p class="mt-2 text-xs text-slate-500">
                        Contoh: Rp 150.000
                    </p>

                </div>


                {{-- CURRENT VALUE --}}
                <div
                    class="
                        mt-5
                        flex items-center justify-between
                        rounded-xl
                        border border-red-200
                        bg-white
                        px-4 py-3
                    "
                >

                    <span class="text-sm text-slate-500">
                        Denda saat ini
                    </span>

                    <span class="font-bold text-red-600">
                        Rp {{ number_format(
                            $pembayaran->denda ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}
                    </span>

                </div>


                {{-- WARNING --}}
                <div
                    class="
                        mt-5
                        flex items-start gap-3
                        rounded-xl
                        border border-amber-200
                        bg-amber-50
                        px-4 py-3
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.1 12.28A2 2 0 004.92 19h14.16a2 2 0 001.73-2.86l-7.1-12.28a2 2 0 00-3.42 0z"
                        />
                    </svg>

                    <div>

                        <p class="text-sm font-semibold text-amber-800">
                            Perhatian
                        </p>

                        <p class="mt-1 text-xs leading-5 text-amber-700">
                            Perubahan nominal denda akan langsung memperbarui
                            data denda pada pembayaran reservasi ini.
                            Pastikan nominal yang dimasukkan sudah benar.
                        </p>

                    </div>

                </div>


                {{-- ACTION --}}
                <div
                    class="
                        mt-6
                        flex flex-col-reverse gap-3
                        sm:flex-row sm:justify-end
                    "
                >

                    <a
                        href="{{ route('admin.pembayaran.index') }}"
                        class="
                            inline-flex items-center justify-center
                            rounded-xl
                            border border-slate-300
                            bg-white
                            px-5 py-3
                            text-sm font-semibold
                            text-slate-700
                            transition
                            hover:bg-slate-50
                        "
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="
                            inline-flex items-center justify-center
                            rounded-xl
                            bg-amber-500
                            px-5 py-3
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition
                            hover:bg-amber-600
                            focus:outline-none
                            focus:ring-2
                            focus:ring-amber-500
                            focus:ring-offset-2
                        "
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
```

</div>

{{-- CURRENCY FORMAT --}}
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const displayInput = document.getElementById('denda_display');
    const hiddenInput = document.getElementById('denda');

    if (!displayInput || !hiddenInput) {
        return;
    }


    function formatRupiah(value) {

        const rawValue = String(value).replace(/\D/g, '');

        if (!rawValue) {
            return '';
        }

        return new Intl.NumberFormat('id-ID').format(
            Number(rawValue)
        );
    }


    displayInput.addEventListener('input', function () {

        const rawValue = this.value.replace(/\D/g, '');

        hiddenInput.value = rawValue;

        this.value = formatRupiah(rawValue);

    });


    /*
     * Pastikan nilai dari database
     * langsung tampil sebagai format Rupiah.
     */
    if (hiddenInput.value) {

        displayInput.value = formatRupiah(
            hiddenInput.value
        );

    }

});

</script>

@endpush

@endsection
