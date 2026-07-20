<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Bus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.3.3/build/css/intlTelInput.css"/>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="bg-slate-950 text-white antialiased">

<div class="min-h-screen flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-5xl grid md:grid-cols-2 gap-8">

        @if($errors->any())
        <script>
        
        const errors = @json($errors->all());
        
        errors.forEach((error, index) => {
        
            setTimeout(() => {
        
                Toastify({
                    text: error,
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    close: true,
                    stopOnFocus: true,
                    style: {
                        background: "#dc2626",
                        borderRadius: "12px"
                    }
                }).showToast();
        
            }, index * 350);
        
        });
        
        </script>
        @endif

        {{-- LEFT: INFO ARMADA --}}
        <div class="bg-slate-900 p-8 rounded-2xl border border-white/10">

            <h2 class="text-2xl font-bold mb-4">Detail Armada</h2>

            <p class="text-lg font-semibold">
                {{ $armada->jenis_kendaraan ?? 'Pilih Armada' }}
            </p>

            <p class="text-gray-400 text-sm mb-2">
                Kapasitas: {{ $armada->kapasitas ?? '-' }} Orang
            </p>

            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($armada->fasilitas ?? [] as $f)
                    <span class="text-xs bg-slate-800 px-2 py-1 rounded">
                        {{ $f->nama_fasilitas }}
                    </span>
                @endforeach
            </div>

            <p class="text-red-500 text-xl font-bold">
                Rp {{ number_format($armada->harga_sewa ?? 0,0,',','.') }}
            </p>

            <p class="text-gray-500 text-sm mt-4">
                * Harga dapat menyesuaikan dengan jarak & durasi perjalanan
            </p>

        </div>

        {{-- RIGHT: FORM --}}
        <div class="bg-slate-900 p-8 rounded-2xl border border-white/10">

            <h2 class="text-2xl font-bold mb-6">Form Booking</h2>

            <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-5">
                @csrf

                <input type="hidden" name="armada_id" value="{{ $armada->id_armada ?? '' }}">

                {{-- NAMA --}}
                <div>
                    <label class="text-sm text-gray-400">Nama Lengkap</label>
                    <input type="text" placeholder="Nama customer" name="nama" required
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="text-sm text-gray-400">Alamat</label>
                    <input name="alamat" type="text" name="alamat" required
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500">
                </div>

                {{-- PHONE --}}
                <div>
                    <label class="text-sm text-gray-400">Nomor WhatsApp</label>
                    <input name="nohp" type="tel" id="phone"
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2">
                    <input type="hidden" name="no_hp" id="no_hp">
                </div>


                {{-- TANGGAL --}}
                <div>
                    <label class="text-sm text-gray-400">Tanggal Keberangkatan</label>
                    <input type="date" name="tanggal_reservasi" required
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2">
                </div>

                {{-- WAKTU --}}
                <div>
                    <label class="text-sm text-gray-400">Waktu Keberangkatan</label>
                    <input type="time" name="waktu" required
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2">
                </div>

                {{-- TUJUAN --}}
                <div>
                    <label class="text-sm text-gray-400">Tujuan</label>
                    <input type="text" name="tujuan" required
                        placeholder="Contoh: Padang - Bukittinggi"
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2">
                </div>

                {{-- PENUMPANG --}}
                <div>
                    <label class="text-sm text-gray-400">Jumlah Penumpang</label>
                    <input placeholder="Sesuaikan dengan kapasitas armada" type="number" name="jumlah_penumpang" required
                        class="w-full mt-1 bg-slate-800 border border-white/10 rounded-lg px-4 py-2">
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-lg font-semibold transition">
                    Booking Sekarang
                </button>

            </form>

        </div>

    </div>

</div>

{{-- PHONE SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.3.3/build/js/intlTelInput.min.js"></script>

<script>

window.onload = () => {
    const firstError = document.querySelector(".border-red-500");

    if(firstError){
        firstError.focus();
        firstError.scrollIntoView({
            behavior:"smooth",
            block:"center"
        });
    }
}
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

</body>
</html>