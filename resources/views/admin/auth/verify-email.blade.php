<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify Email - Wanderlusth Cantigi Tour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0f172a] relative flex items-center justify-center overflow-hidden">

    <!-- Ambient Glow -->
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-3xl"></div>

    <div
        class="relative w-full max-w-5xl min-h-[600px]
        bg-white/[0.04] backdrop-blur-2xl border border-white/10
        rounded-3xl shadow-[0_20px_80px_rgba(0,0,0,.6)]
        overflow-hidden grid grid-cols-1 lg:grid-cols-2">

        <!-- LEFT -->
        <div class="p-10 lg:p-12 flex flex-col justify-between">

            <div>

                <!-- Logo -->
                <div class="mb-8 text-center lg:text-left">

                    <div
                        class="w-14 h-14 mx-auto lg:mx-0 mb-5 rounded-xl
                        bg-gradient-to-br from-indigo-500 to-purple-600
                        flex items-center justify-center
                        shadow-lg shadow-indigo-500/30">

                        <!-- Mail Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-7 h-7 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>

                    </div>

                    <h2 class="text-3xl font-semibold text-white">
                        Verify Your Email
                    </h2>

                    <p class="text-slate-400 mt-2 text-sm">
                        Wanderlusth Cantigi Tour Administration
                    </p>

                </div>

                <!-- Information -->
                <div
                    class="rounded-xl border border-indigo-500/20
                    bg-indigo-500/10 p-5 mb-6">

                    <p class="text-slate-300 leading-relaxed text-sm">

                        Thanks for registering!

                        Before accessing your dashboard, please verify your email
                        address by clicking the verification link we sent.

                        If you didn't receive the email, simply request another one below.

                    </p>

                </div>
                
                <div class="mt-4 rounded-lg bg-slate-900/50 border border-slate-700 p-4">
                    <p class="text-xs text-slate-400">
                        Verification email has been sent to
                    </p>
                
                    <p class="text-indigo-400 font-medium mt-1">
                        {{ Auth::user()->email }}
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')

                    <div
                        class="mb-6 rounded-xl border border-green-500/20
                        bg-green-500/10 p-4 text-green-300 text-sm">

                        ✅ A new verification email has been sent successfully.

                    </div>

                @endif

                <div class="space-y-4">

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full py-3 rounded-lg
                            bg-gradient-to-r from-indigo-600 to-purple-600
                            text-white font-semibold tracking-wide
                            shadow-lg shadow-indigo-600/30
                            hover:-translate-y-1
                            hover:shadow-indigo-500/50
                            transition">

                            Send Verification Email Again

                        </button>

                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full py-3 rounded-lg
                            border border-slate-700
                            bg-slate-900/50
                            text-slate-300
                            hover:bg-slate-800
                            hover:text-white
                            transition">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

            <p class="text-xs text-slate-500 mt-8">
                © 2026 PT. Wanderlusth Cantigi International
            </p>

        </div>

        <!-- RIGHT -->
        <div class="hidden lg:block relative">

            <img
                src="{{ asset('image/gallery/gallery29.jpg') }}"
                class="w-full h-full object-cover"
                alt="Verify Email">

            <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-black/40 to-transparent"></div>

            <div class="absolute bottom-10 left-10 right-10">

                <div
                    class="bg-black/30 backdrop-blur-md
                    border border-white/10 rounded-2xl
                    p-6">

                    <h3 class="text-2xl font-semibold text-white mb-3">
                        One Step Away
                    </h3>

                    <p class="text-slate-200 leading-relaxed text-sm">

                        Email verification protects your account and ensures only
                        authorized administrators can access the reservation system.

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>