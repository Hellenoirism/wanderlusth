<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        @yield('title', 'Admin Panel')
    </title>

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- CHART --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- FLATPICKR --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body class="bg-slate-950 text-white antialiased scroll-smooth">

    <div class="min-h-screen flex bg-slate-950">

        <!-- SIDEBAR -->
        <aside class="
            w-72 shrink-0
            bg-slate-900/95
            border-r border-white/10
            backdrop-blur-xl
            flex flex-col
        ">

            <!-- BRAND -->
            <div class="px-6 py-6 border-b border-white/10">

                <h1 class="text-2xl font-bold tracking-tight">
                    Admin Panel
                </h1>

                <p class="text-sm text-slate-400 mt-1">
                    Sistem Reservasi Bus Pariwisata
                </p>

            </div>

            <!-- NAVIGATION -->
            <div class="flex-1 overflow-y-auto px-4 py-6">

                <nav class="space-y-8">

                    <!-- MAIN -->
                    <div>

                        <p class="
                            px-3 mb-3
                            text-xs font-semibold
                            tracking-widest
                            text-slate-500 uppercase
                        ">
                            Main
                        </p>

                        <div class="space-y-1.5">

                            <!-- DASHBOARD -->
                            <a href="{{ route('admin.dashboard') }}"
                                class="
                                    group flex items-center gap-3
                                    px-4 py-3 rounded-2xl
                                    transition-all duration-200

                                    {{ request()->routeIs('admin.dashboard')
                                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                    }}
                                ">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 10l9-7 9 7v11a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1V10z" />

                                </svg>

                                <span class="font-medium">
                                    Halaman Utama
                                </span>

                            </a>

                        </div>

                    </div>

                    <!-- MASTER DATA -->
                    <div>

                        <p class="
                            px-3 mb-3
                            text-xs font-semibold
                            tracking-widest
                            text-slate-500 uppercase
                        ">
                            Master Data
                        </p>

                        <div class="space-y-1.5">

                            <!-- ARMADA -->
                            <a href="{{ route('admin.armada.index') }}"
                                class="
                                    group flex items-center gap-3
                                    px-4 py-3 rounded-2xl
                                    transition-all duration-200

                                    {{ request()->routeIs('admin.armada.*')
                                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                    }}
                                ">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 16V8m8 8V8M4 20h16" />

                                </svg>

                                <span class="font-medium">
                                    Armada
                                </span>

                            </a>

                            <!-- FASILITAS -->
                            <a href="{{ route('admin.fasilitas.index') }}"
                                class="
                                    group flex items-center gap-3
                                    px-4 py-3 rounded-2xl
                                    transition-all duration-200

                                    {{ request()->routeIs('admin.fasilitas.*')
                                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                    }}
                                ">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6M7 4h10l1 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6l1-2z" />

                                </svg>

                                <span class="font-medium">
                                    Fasilitas
                                </span>

                            </a>

                        </div>

                    </div>

                    <!-- TRANSAKSI -->
                    <div>

                        <p class="
                            px-3 mb-3
                            text-xs font-semibold
                            tracking-widest
                            text-slate-500 uppercase
                        ">
                            Transaksi
                        </p>

                        <div class="space-y-1.5">

                            <!-- RESERVASI -->
                            <a href="{{ route('admin.reservasi.index') }}"
                                class="
                                    group flex items-center gap-3
                                    px-4 py-3 rounded-2xl
                                    transition-all duration-200

                                    {{ request()->routeIs('admin.reservasi.*')
                                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                    }}
                                ">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

                                </svg>

                                <span class="font-medium">
                                    Reservasi
                                </span>

                            </a>

                            <!-- PEMBAYARAN -->
                            <a href="{{ route('admin.pembayaran.index') }}"
                                class="
                                    group flex items-center gap-3
                                    px-4 py-3 rounded-2xl
                                    transition-all duration-200

                                    {{ request()->routeIs('admin.pembayaran.*')
                                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                    }}
                                ">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 9V7a5 5 0 00-10 0v2M5 9h14l1 11H4L5 9z" />

                                </svg>

                                <span class="font-medium">
                                    Pembayaran
                                </span>

                            </a>

                        </div>

                    </div>

                    <!-- LAPORAN -->
                    <div>

                        <p class="
                            px-3 mb-3
                            text-xs font-semibold
                            tracking-widest
                            text-slate-500 uppercase
                        ">
                            Laporan
                        </p>

                        <div class="space-y-1.5">

                            <a href="{{ route('admin.laporan.index') }}"
                                class="
                                    group flex items-center gap-3
                                    px-4 py-3 rounded-2xl
                                    transition-all duration-200

                                    {{ request()->routeIs('admin.laporan.*')
                                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                    }}
                                ">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 17v-6m4 6V7m4 10v-3M5 21h14" />

                                </svg>

                                <span class="font-medium">
                                    Laporan
                                </span>

                            </a>

                        </div>

                    </div>

                </nav>

            </div>

            <!-- USER -->
            <div class="
                relative
                border-t border-white/10
                p-4 bg-white/[0.02]
            ">
            
                <button
                    id="userMenuButton"
                    type="button"
                    class="
                        w-full
                        flex items-center gap-3
                        p-3 rounded-2xl
                        hover:bg-white/5
                        transition-all duration-200
                        text-left
                    "
                >
            
                    <img
                        src="{{ auth()->user()->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->username) }}"
                        class="
                            w-12 h-12 rounded-full
                            object-cover
                            border border-white/10
                        "
                    >
            
                    <div class="min-w-0 flex-1">
            
                        <p class="font-medium truncate">
                            {{ auth()->user()->username }}
                        </p>
            
                        <p class="text-xs text-slate-400">
                            Administrator
                        </p>
            
                    </div>
            
                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="
                            w-5 h-5 text-slate-400
                            transition-transform duration-200
                        "
                        id="userMenuArrow"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
            
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
            
                    </svg>
            
                </button>
            
                <!-- DROPDOWN -->
                <div
                    id="userDropdown"
                    class="
                        absolute
                        bottom-full left-4 right-4 mb-3
                        hidden
                        overflow-hidden
                        rounded-2xl
                        border border-white/10
                        bg-slate-900/95
                        backdrop-blur-xl
                        shadow-2xl
                        shadow-black/40
                        z-50
                    "
                >
            
                    <!-- HEADER -->
                    <div class="p-4 border-b border-white/10">
            
                        <p class="font-semibold text-white truncate">
                            {{ auth()->user()->username }}
                        </p>
            
                        <p class="text-sm text-slate-400 truncate">
                            {{ auth()->user()->email }}
                        </p>
            
                    </div>
            
                    <!-- MENU -->
                    <div class="p-2 space-y-1">
            
                        <!-- PROFILE -->
                        <a
                            href="{{ route('admin.profile') }}"
                            class="
                                flex items-center gap-3
                                px-4 py-3 rounded-xl
                                text-sm text-slate-300
                                hover:bg-white/5
                                hover:text-white
                                transition-all duration-200
                            "
                        >
            
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
            
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
            
                            </svg>
            
                            Profile
            
                        </a>
            
                        <!-- LOGOUT -->
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
            
                            @csrf
            
                            <button
                                type="submit"
                                class="
                                    w-full
                                    flex items-center gap-3
                                    px-4 py-3 rounded-xl
                                    text-sm text-red-400
                                    hover:bg-red-500/10
                                    hover:text-red-300
                                    transition-all duration-200
                                "
                            >
            
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
            
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V7m0 14a2 2 0 01-2-2V5a2 2 0 012-2"
                                    />
            
                                </svg>
            
                                Logout
            
                            </button>
            
                        </form>
            
                    </div>
            
                </div>
            
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- TOPBAR -->
            <header class="
                sticky top-0 z-20
                h-20 shrink-0
                border-b border-white/10
                bg-slate-900/80
                backdrop-blur-xl
            ">

                <div class="
                    h-full px-8
                    flex items-center justify-between
                ">

                    <!-- LEFT -->
                    <div class="min-w-0">

                        <h2 class="
                            text-2xl font-bold
                            tracking-tight
                            truncate
                        ">
                            @yield('page-title')
                        </h2>

                        <p class="
                            text-sm text-slate-400
                            mt-1 truncate
                        ">
                            @yield('page-description')
                        </p>

                    </div>

                    <!-- RIGHT -->
                    <div class="flex items-center gap-4">

                        <div class="text-right hidden sm:block">

                            <p class="text-sm font-medium">
                                {{ auth()->user()->username }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Administrator
                            </p>

                        </div>

                        <img
                            src="{{ auth()->user()->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->username) }}"
                            class="
                                w-11 h-11 rounded-full
                                object-cover
                                border border-white/10
                            ">

                    </div>

                </div>

            </header>

            <!-- PAGE CONTENT -->
            <main class="
                flex-1
                overflow-y-auto
                overflow-x-hidden
                p-8
                bg-gradient-to-br
                from-slate-950
                via-slate-900
                to-indigo-950
            ">

                <div class="max-w-7xl mx-auto">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

    @stack('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', () => {
    
            const button =
                document.getElementById('userMenuButton');
    
            const dropdown =
                document.getElementById('userDropdown');
    
            const arrow =
                document.getElementById('userMenuArrow');
    
            /*
            |--------------------------------------------------------------------------
            | TOGGLE DROPDOWN
            |--------------------------------------------------------------------------
            */
    
            button.addEventListener('click', (e) => {
    
                e.stopPropagation();
    
                dropdown.classList.toggle('hidden');
    
                arrow.classList.toggle('rotate-180');
            });
    
            /*
            |--------------------------------------------------------------------------
            | CLOSE WHEN CLICK OUTSIDE
            |--------------------------------------------------------------------------
            */
    
            document.addEventListener('click', (e) => {
    
                if (
                    !dropdown.contains(e.target) &&
                    !button.contains(e.target)
                ) {
    
                    dropdown.classList.add('hidden');
    
                    arrow.classList.remove('rotate-180');
                }
            });
    
        });
    
    </script>

</body>

</html>