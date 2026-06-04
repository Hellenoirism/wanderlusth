@extends('admin.layouts.app')
@push('styles')
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.3.3/build/css/intlTelInput.css"/>
@endpush

@section('title', 'Tambah Reservasi')
@section('page-title', 'Tambah Reservasi')

@section('content')

<div class="max-w-2xl mx-auto text-gray-800">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

        {{-- HEADER --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Tambah Reservasi
            </h2>

            <p class="text-sm text-gray-500">
                Tambahkan data reservasi baru
            </p>
        </div>

        @if ($errors->any())
    <div class="bg-red-100 text-red-600 p-4 rounded-xl">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form
            action="{{ route('admin.reservasi.store') }}"
            method="POST"
            class="space-y-5"
        >
            @csrf

            {{-- PELANGGAN --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Pelanggan
                </label>
            
                <input
                    type="text"
                    name="nama_pelanggan"
                    value="{{ old('nama_pelanggan') }}"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Nama lengkap pelanggan"
                >
            
                @error('nama_pelanggan')
                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            
            </div>


            {{-- Alamat --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Alamat
                </label>
            
                <textarea
                    name="alamat"
                    rows="3"
                    class="w-full mt-1 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Alamat pelanggan"
                >{{ old('alamat') }}</textarea>
            
                @error('alamat')
                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            
            </div>
            {{-- NOMOR WHATSAPP --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nomor WhatsApp
                </label>
            
                <input
                    type="tel"
                    id="phone"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                >
            
                <input
                    type="hidden"
                    name="no_hp"
                    id="no_hp"
                    value="{{ old('no_hp') }}"
                >
            
                @error('no_hp')
                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            
            </div>

            {{-- ARMADA --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Armada
                </label>

                <select
                    name="id_armada"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                >

                    <option value="">
                        Pilih Armada
                    </option>

                    @foreach($armadas as $armada)

                        <option
                            value="{{ $armada->id_armada }}"
                            {{ old('id_armada') == $armada->id_armada ? 'selected' : '' }}
                        >
                            {{ $armada->jenis_kendaraan }}
                            ({{ $armada->kapasitas }} Orang)
                        </option>

                    @endforeach

                </select>

                @error('id_armada')
                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- TUJUAN --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Tujuan
                </label>

                <input
                    type="text"
                    name="tujuan"
                    value="{{ old('tujuan') }}"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Contoh: Padang - Jakarta"
                >

                @error('tujuan')
                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- TANGGAL & WAKTU --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Tanggal Reservasi
                    </label>

                    <input
                        type="date"
                        name="tanggal_reservasi"
                        value="{{ old('tanggal_reservasi') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    >

                    @error('tanggal_reservasi')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Waktu Keberangkatan
                    </label>

                    <input
                        type="time"
                        name="waktu"
                        value="{{ old('waktu') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    >

                    @error('waktu')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- JUMLAH PENUMPANG --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Jumlah Penumpang
                </label>

                <input
                    type="number"
                    min="1"
                    name="jumlah_penumpang"
                    value="{{ old('jumlah_penumpang') }}"
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Contoh: 35"
                >

                @error('jumlah_penumpang')
                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- ACTION --}}
            <div class="flex justify-between items-center pt-4">

                <a
                    href="{{ route('admin.reservasi.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 transition"
                >
                    ← Kembali
                </a>

                <button
                    type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl shadow hover:bg-indigo-700 transition"
                >
                    Simpan Reservasi
                </button>

            </div>

        </form>

    </div>

</div>
@push('scripts')

{{-- PHONE SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.3.3/build/js/intlTelInput.min.js"></script>

<script>
const phoneInput = document.querySelector("#phone");
const hiddenPhone = document.querySelector("#no_hp");

const iti = window.intlTelInput(phoneInput, {
    initialCountry: "id",
    preferredCountries: ["id","sg","my"],
    separateDialCode: true,
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.3.3/build/js/utils.js"
});

phoneInput.addEventListener("blur", () => {
    hiddenPhone.value = iti.isValidNumber() ? iti.getNumber() : "";
});
</script>   

@endpush
@endsection