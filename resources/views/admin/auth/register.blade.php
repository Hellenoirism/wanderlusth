<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Wanderlusth Cantigi Tour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0f172a] relative flex items-center justify-center overflow-hidden">

    <!-- Ambient Glow -->
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-3xl"></div>

<div class="relative w-full max-w-4xl min-h-[580px]
bg-white/[0.04] backdrop-blur-2xl border border-white/10
rounded-3xl shadow-[0_20px_80px_rgba(0,0,0,0.6)]
overflow-hidden grid grid-cols-1 lg:grid-cols-2">

    <!-- LEFT SIDE -->
    <div class="p-10 lg:p-12 flex flex-col justify-between">

        <div>

            <!-- HEADER -->
            <div class="mb-5 text-center lg:text-left">
                <div class="w-12 h-12 mx-auto lg:mx-0 mb-4 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md shadow-indigo-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-semibold text-white tracking-wide">
                    Buat Akun Admin
                </h2>
                <p class="text-slate-400 mt-2 text-sm">
                    Daftarkan akun untuk mengakses dashboard
                </p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- ERROR -->
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-lg px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- NAME -->
                <div>
                    <label class="block text-sm text-slate-300 mb-1.5">Nama</label>
                    <input type="text" name="username" required
                        class="w-full px-4 py-2.5 bg-slate-900/60 border border-slate-700 rounded-lg text-white placeholder-slate-500 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                        focus:shadow-md focus:shadow-indigo-500/20 transition duration-300"
                        placeholder="Nama Lengkap">
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm text-slate-300 mb-1.5">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2.5 bg-slate-900/60 border border-slate-700 rounded-lg text-white placeholder-slate-500 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                        focus:shadow-md focus:shadow-indigo-500/20 transition duration-300"
                        placeholder="admin@company.com">
                </div>

                <!-- PASSWORD -->
<div>
    <label class="block text-sm text-slate-300 mb-1.5">Password</label>

    <div class="relative">
        <input
            id="password"
            type="password"
            name="password"
            required
            placeholder="••••••••"
            class="w-full px-4 py-2.5 pr-12 bg-slate-900/60 border border-slate-700 rounded-lg text-white placeholder-slate-500
            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
            focus:shadow-md focus:shadow-indigo-500/20 transition duration-300">

        <button
            type="button"
            class="toggle-password absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-white transition"
            data-target="password">

            <svg class="eye-open w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>

            <svg class="eye-closed hidden w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.132 5.411M3 3l18 18"/>
            </svg>

        </button>
    </div>
</div>

<!-- CONFIRM PASSWORD -->
<div>
    <label class="block text-sm text-slate-300 mb-1.5">
        Konfirmasi Password
    </label>

    <div class="relative">

        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            required
            placeholder="••••••••"
            class="w-full px-4 py-2.5 pr-12 bg-slate-900/60 border border-slate-700 rounded-lg text-white placeholder-slate-500
            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
            focus:shadow-md focus:shadow-indigo-500/20 transition duration-300">

        <button
            type="button"
            class="toggle-password absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-white transition"
            data-target="password_confirmation">

            <svg class="eye-open w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>

            <svg class="eye-closed hidden w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.132 5.411M3 3l18 18"/>
            </svg>

        </button>

    </div>
</div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full py-2.5 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600
                    text-white font-semibold tracking-wide
                    shadow-md shadow-indigo-600/30
                    hover:shadow-indigo-500/50 hover:-translate-y-[1px]
                    transition duration-300">
                    Daftar Sekarang
                </button>

                <!-- LOGIN LINK -->
                <div class="text-center pt-3 text-sm text-slate-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="text-indigo-400 hover:text-indigo-300 font-medium transition">
                        Masuk di sini
                    </a>
                </div>

            </form>

        </div>

        <!-- FOOTER -->
        <p class="text-center lg:text-left text-slate-500 text-xs mt-6">
            © 2026 PT. Wanderlusth Cantigi International
        </p>

    </div>

    <!-- RIGHT SIDE -->
    <div class="relative hidden lg:block">
        <img src="{{ asset('image/gallery/gallery29.jpg') }}"
             class="h-full w-full object-cover"
             alt="Register Image">

        <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-black/40 to-transparent"></div>

        <div class="absolute bottom-10 left-10 text-white max-w-sm">
            <h3 class="text-xl font-semibold mb-3">
                Sistem Reservasi Bus Pariwisata
            </h3>
            <p class="text-sm text-slate-200 leading-relaxed">
                Kelola armada, jadwal, dan reservasi dalam satu dashboard yang modern dan efisien.
            </p>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
    
        button.addEventListener('click', function () {
    
            const input = document.getElementById(this.dataset.target);
    
            const eyeOpen = this.querySelector('.eye-open');
            const eyeClosed = this.querySelector('.eye-closed');
    
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
    
        });
    
    });
    </script>
    
</body>
</html>