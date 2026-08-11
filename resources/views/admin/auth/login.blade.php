<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Wanderlusth Cantigi Tour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0f172a] relative flex items-center justify-center overflow-hidden">

    <!-- Ambient Glow -->
    <div
    aria-hidden="true"
    class="pointer-events-none absolute inset-0 overflow-hidden"
>
    <div
        class="absolute -left-40 -top-40 h-[520px] w-[520px]
               rounded-full bg-indigo-600/20 blur-[120px]"
    ></div>

    <div
        class="absolute -bottom-48 -right-40 h-[520px] w-[520px]
               rounded-full bg-purple-600/15 blur-[120px]"
    ></div>

    <div
        class="absolute left-1/2 top-1/2 h-[300px] w-[300px]
               -translate-x-1/2 -translate-y-1/2
               rounded-full bg-blue-500/5 blur-[100px]"
    ></div>
</div>

<div
    class="
        relative
        z-10
        w-full
        max-w-[1180px]

        overflow-hidden
        rounded-[28px]

        border
        border-white/[0.08]

        bg-[#0b1120]/95

        shadow-[0_35px_100px_-25px_rgba(0,0,0,0.75)]

        backdrop-blur-2xl

        lg:grid
        lg:grid-cols-[0.92fr_1.08fr]

        lg:h-[calc(100vh-80px)]
        lg:max-h-[760px]
        lg:min-h-[680px]
    "
>

<!-- LEFT SIDE -->

<div
    class="
        relative
        flex
        min-h-0
        flex-col
        justify-between
        overflow-hidden

        p-7
        sm:p-8
        lg:p-10
    "
>

```
<!-- Decorative glow -->
<div
    aria-hidden="true"
    class="pointer-events-none absolute -left-24 top-10 h-48 w-48 rounded-full bg-indigo-500/10 blur-3xl"
></div>

<div class="relative z-10">

    <!-- BRAND HEADER -->
    <div class="mb-6">

        <div class="flex items-center gap-3">

            <!-- Logo -->
            <div
                class="
                    flex h-12 w-12 shrink-0 items-center justify-center
                    rounded-2xl
                    bg-gradient-to-br from-indigo-500 to-purple-600
                    shadow-lg shadow-indigo-600/25
                "
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </div>

            <div>

                <p class="text-sm font-semibold tracking-wide text-white">
                    Wanderlusth Cantigi
                </p>

                <p class="mt-0.5 text-[11px] uppercase tracking-[0.16em] text-slate-500">
                    Administrator Portal
                </p>

            </div>

        </div>


        <!-- INTRO -->
        <div class="mt-6">

            <div
                class="
                    mb-3 inline-flex items-center gap-2
                    rounded-full
                    border border-indigo-500/20
                    bg-indigo-500/10
                    px-3 py-1.5
                "
            >

                <span
                    class="h-1.5 w-1.5 rounded-full bg-indigo-400 shadow-sm shadow-indigo-400"
                ></span>

                <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-indigo-300">
                    Secure Access
                </span>

            </div>


            <h2
                class="
                    max-w-md
                    text-3xl
                    font-semibold
                    leading-tight
                    tracking-tight
                    text-white
                    sm:text-[2.1rem]
                "
            >
                Selamat datang kembali.
            </h2>


            <p
                class="
                    mt-3
                    max-w-md
                    text-sm
                    leading-6
                    text-slate-400
                "
            >
                Masuk ke dashboard administrator untuk mengelola
                reservasi, armada, pembayaran, dan operasional
                perjalanan.
            </p>

        </div>

    </div>


    <!-- LOGIN FORM -->
    <form
        method="POST"
        action="{{ route('login') }}"
        class="space-y-4"
    >

        @csrf


        <!-- ERROR -->
        <div class="min-h-[52px]">

            @if ($errors->any())

                <div
                    role="alert"
                    class="
                    flex items-center gap-3
                    rounded-xl
                    border border-red-500/20
                    bg-red-500/10
                    px-4 py-3
                "
                >

                    <div
                        class="
                            flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-lg
                            bg-red-500/10
                            text-red-400
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3m0 4h.01M10.29 3.86l-7.1 12.28A2 2 0 004.92 19h14.16a2 2 0 001.73-2.86l-7.1-12.28a2 2 0 00-3.42 0z"
                            />
                        </svg>
                    </div>

                    <div>

                        <p class="text-xs font-semibold text-red-300">
                            Login gagal
                        </p>

                        <p class="mt-0.5 text-[11px] text-red-400/80">
                            Email atau password tidak sesuai.
                        </p>

                    </div>

                </div>

            @endif

        </div>


        <!-- EMAIL -->
        <div>

            <label
                for="email"
                class="mb-2 block text-xs font-medium text-slate-300"
            >
                Email
            </label>

            <div class="relative">

                <div
                    aria-hidden="true"
                    class="
                        pointer-events-none absolute inset-y-0 left-0
                        flex items-center pl-4
                        text-slate-600
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>
                </div>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                    placeholder="admin@company.com"
                    class="
                        w-full
                        rounded-xl
                        border border-slate-700/80
                        bg-slate-900/60
                        py-3 pl-11 pr-4
                        text-sm text-white
                        placeholder-slate-600
                        outline-none
                        transition duration-200
                        hover:border-slate-600
                        focus:border-indigo-500
                        focus:ring-4
                        focus:ring-indigo-500/10
                    "
                />

            </div>

        </div>


        <!-- PASSWORD -->
        <div>

            <div class="mb-2 flex items-center justify-between">

                <label
                    for="password"
                    class="text-xs font-medium text-slate-300"
                >
                    Password
                </label>

                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="
                            text-[11px]
                            font-medium
                            text-indigo-400
                            transition
                            hover:text-indigo-300
                        "
                    >
                        Lupa password?
                    </a>

                @endif

            </div>


            <div class="relative">

                <div
                    aria-hidden="true"
                    class="
                        pointer-events-none absolute inset-y-0 left-0
                        flex items-center pl-4
                        text-slate-600
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            x="4"
                            y="10"
                            width="16"
                            height="10"
                            rx="2"
                        />
                        <path
                            stroke-linecap="round"
                            d="M8 10V7a4 4 0 018 0v3"
                        />
                    </svg>
                </div>


                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="
                        w-full
                        rounded-xl
                        border border-slate-700/80
                        bg-slate-900/60
                        py-3 pl-11 pr-12
                        text-sm text-white
                        placeholder-slate-600
                        outline-none
                        transition duration-200
                        hover:border-slate-600
                        focus:border-indigo-500
                        focus:ring-4
                        focus:ring-indigo-500/10
                    "
                />


                <button
                    type="button"
                    id="togglePassword"
                    aria-label="Tampilkan password"
                    class="
                        absolute inset-y-0 right-0
                        flex items-center
                        px-4
                        text-slate-500
                        transition
                        hover:text-slate-200
                    "
                >

                    <!-- Eye -->
                    <svg
                        id="eyeOpen"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.478 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.064 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>


                    <!-- Eye Slash -->
                    <svg
                        id="eyeClosed"
                        xmlns="http://www.w3.org/2000/svg"
                        class="hidden h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 3l18 18"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                            c-4.478 0-8.268-2.943-9.542-7
                            a9.956 9.956 0 012.293-3.95"
                        />
                    </svg>

                </button>

            </div>

        </div>


        <!-- REMEMBER -->
        <div class="flex items-center gap-2.5">

            <input
                id="remember"
                type="checkbox"
                name="remember"
                class="
                    h-4 w-4
                    rounded
                    border-slate-700
                    bg-slate-900
                    text-indigo-600
                    focus:ring-2
                    focus:ring-indigo-500/20
                "
            >

            <label
                for="remember"
                class="text-xs text-slate-500"
            >
                Ingat saya di perangkat ini
            </label>

        </div>


        <!-- BUTTON -->
        <button
            type="submit"
            class="
                group
                relative
                w-full
                overflow-hidden
                rounded-xl
                bg-gradient-to-r
                from-indigo-600
                to-purple-600
                py-3.5
                text-sm
                font-semibold
                tracking-wide
                text-white
                shadow-lg
                shadow-indigo-600/20
                transition-all
                duration-300
                hover:-translate-y-0.5
                hover:shadow-xl
                hover:shadow-indigo-600/30
                focus:outline-none
                focus:ring-4
                focus:ring-indigo-500/20
            "
        >

            <span
                class="
                    absolute inset-0
                    -translate-x-full
                    bg-gradient-to-r
                    from-transparent
                    via-white/10
                    to-transparent
                    transition-transform
                    duration-700
                    group-hover:translate-x-full
                "
            ></span>

            <span class="relative flex items-center justify-center gap-2">

                Masuk ke Dashboard

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform group-hover:translate-x-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                    />
                </svg>

            </span>

        </button>


        <!-- REGISTER -->
        <div class="pt-1 text-center">

            <span class="text-xs text-slate-500">
                Belum punya akun?
            </span>

            <a
                href="{{ route('register') }}"
                class="
                    ml-1
                    text-xs
                    font-semibold
                    text-indigo-400
                    transition
                    hover:text-indigo-300
                "
            >
                Daftar sekarang
            </a>

        </div>

    </form>

</div>


<!-- FOOTER -->
<div class="relative z-10 mt-5">

    <div
        class="
            mb-3
            h-px
            bg-gradient-to-r
            from-transparent
            via-slate-800
            to-transparent
        "
    ></div>

    <p class="text-center text-[10px] text-slate-600 lg:text-left">
        © {{ date('Y') }} PT. Wanderlusth Cantigi International
    </p>

</div>
```

</div>


<!-- RIGHT SIDE -->

<div class="
relative
hidden
min-h-0
overflow-hidden
lg:block
">

```
<!-- IMAGE -->
<img
    src="{{ asset('image/gallery/gallery29.jpg') }}"
    alt="Armada bus pariwisata Wanderlusth Cantigi"
    class="
        absolute
        inset-0
        h-full
        w-full
        object-cover
        transition-transform
        duration-[1500ms]
        hover:scale-[1.03]
    "
>


<!-- IMAGE COLOR GRADING -->
<div
    aria-hidden="true"
    class="
        absolute inset-0
        bg-gradient-to-br
from-slate-950/45
via-slate-900/10
to-indigo-950/40
    "
></div>


<!-- LEFT BLEND -->
<div
    aria-hidden="true"
    class="
        absolute inset-y-0 left-0
        w-24
bg-gradient-to-r
from-[#0f172a]/80
via-[#0f172a]/30
to-transparent
    "
></div>


<!-- TOP BADGE -->
<div
    class="
        absolute
        left-8
        top-8
        inline-flex
        items-center
        gap-2
        rounded-full
        border border-white/15
        bg-slate-950/25
        px-4 py-2
        shadow-lg
        backdrop-blur-md
    "
>

    <span
        class="
            h-1.5
            w-1.5
            rounded-full
            bg-emerald-400
            shadow-[0_0_10px_rgba(52,211,153,0.7)]
        "
    ></span>

    <span
        class="
            text-[10px]
            font-medium
            uppercase
            tracking-[0.18em]
            text-white/80
        "
    >
        Travel Management System
    </span>

</div>


<!-- CONTENT -->
<div
    class="
        absolute
        bottom-10
        left-10
        right-10
        max-w-lg
    "
>

    <p
        class="
            mb-3
            text-[11px]
            font-semibold
            uppercase
            tracking-[0.22em]
            text-indigo-300
        "
    >
        Wanderlusth Cantigi
    </p>


    <h3
        class="
            text-3xl
            font-semibold
            leading-tight
            tracking-tight
            text-white
        "
    >
        Mengelola perjalanan
        menjadi lebih sederhana.
    </h3>


    <p
        class="
            mt-4
            max-w-md
            text-sm
            leading-6
            text-slate-200/80
        "
    >
        Satu platform untuk mengelola armada,
        reservasi, pembayaran, dan operasional
        perjalanan secara lebih terstruktur.
    </p>


    <!-- FEATURE LINE -->
    <div class="mt-7 flex items-center gap-4">

        <div class="h-px w-10 bg-indigo-400/70"></div>

        <span
            class="
                text-[10px]
                font-medium
                uppercase
                tracking-[0.16em]
                text-white/60
            "
        >
            Reliable · Efficient · Connected
        </span>

    </div>

</div>


<!-- BOTTOM VIGNETTE -->
<div
    aria-hidden="true"
    class="
        absolute
        inset-x-0
        bottom-0
        h-40
        bg-gradient-to-t
        from-slate-950/80
        to-transparent
    "
></div>
```

</div>


<script>
    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    toggle.addEventListener('click', () => {
        const isPassword = password.type === 'password';

        password.type = isPassword ? 'text' : 'password';

        eyeOpen.classList.toggle('hidden', isPassword);
        eyeClosed.classList.toggle('hidden', !isPassword);
    });
</script>
</body>
</html>