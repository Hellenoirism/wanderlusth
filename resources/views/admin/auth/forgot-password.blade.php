<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Wanderlust Cantigi Tour</title>
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
                <div class="mb-6 text-center lg:text-left">

                    <div
                        class="w-12 h-12 mx-auto lg:mx-0 mb-4 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md shadow-indigo-500/30">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15v2m0-8v2m0 8h.01M5.636 18.364a9 9 0 1112.728 0" />
                        </svg>

                    </div>

                    <h2 class="text-2xl font-semibold text-white tracking-wide">
                        Lupa Password
                    </h2>

                    <p class="text-slate-400 mt-2 text-sm">
                        Masukkan alamat email Anda. Kami akan mengirimkan tautan untuk mengatur ulang password.
                    </p>

                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-5 rounded-lg border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">

                    @csrf

                    <!-- EMAIL -->
                    <div>

                        <label class="block text-sm text-slate-300 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus

                            class="w-full px-4 py-2.5
                            bg-slate-900/60
                            border border-slate-700
                            rounded-lg
                            text-white
                            placeholder-slate-500
                            focus:outline-none
                            focus:ring-2
                            focus:ring-indigo-500
                            focus:border-indigo-500
                            focus:shadow-md
                            focus:shadow-indigo-500/20
                            transition duration-300"

                            placeholder="admin@company.com">

                        @error('email')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"

                        class="w-full py-2.5 rounded-lg
                        bg-gradient-to-r
                        from-indigo-600
                        to-purple-600
                        text-white
                        font-semibold
                        tracking-wide
                        shadow-md
                        shadow-indigo-600/30
                        hover:shadow-indigo-500/50
                        hover:-translate-y-[1px]
                        transition duration-300">

                        Kirim Link Reset Password

                    </button>

                    <!-- Back -->
                    <div class="text-center pt-3 text-sm text-slate-400">

                        Ingat password?

                        <a href="{{ route('login') }}"
                            class="text-indigo-400 hover:text-indigo-300 font-medium transition">

                            Kembali ke Login

                        </a>

                    </div>

                </form>

            </div>

            <p class="text-center lg:text-left text-slate-500 text-xs mt-6">
                © 2026 PT. Wanderlust Cantigi International
            </p>

        </div>

        <!-- RIGHT SIDE -->
        <div class="relative hidden lg:block">

            <img src="{{ asset('image/gallery/gallery29.jpg') }}"
                class="h-full w-full object-cover"
                alt="Forgot Password">

            <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-black/40 to-transparent"></div>

            <div class="absolute bottom-10 left-10 text-white max-w-sm">

                <h3 class="text-xl font-semibold mb-3">
                    Amankan Akun Administrator
                </h3>

                <p class="text-sm text-slate-200 leading-relaxed">
                    Demi keamanan sistem reservasi, tautan reset password hanya akan dikirim ke alamat email yang telah terdaftar sebagai administrator.
                </p>

            </div>

        </div>

    </div>

</body>

</html>
```
