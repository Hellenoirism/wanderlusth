@extends('admin.layouts.app')

@section('title', 'Profil')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-white">
            Pengaturan Profil
        </h1>
        <p class="text-gray-400 text-sm">
            Kelola informasi akun administrator
        </p>
    </div>

    <!-- Card -->
    <div class="bg-slate-900/70 backdrop-blur-xl border border-white/10 rounded-2xl shadow-xl p-8">

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="grid md:grid-cols-3 gap-8">

                <!-- Avatar Section -->
                <div class="flex flex-col items-center space-y-4">

                    <img
    src="{{ Auth::user()->profile_photo 
        ? asset('storage/' . Auth::user()->profile_photo) 
        : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
    class="w-32 h-32 rounded-full object-cover border-4 border-white/10 shadow-lg"
>

                    <label class="cursor-pointer bg-gradient-to-r from-purple-500 to-pink-500 text-white text-sm px-4 py-2 rounded-lg hover:opacity-90 transition">
                        Upload Photo
                        <input type="file" name="photo" class="hidden">
                    </label>

                    <p class="text-xs text-gray-400 text-center">
                        PNG, JPG max 2MB
                    </p>

                </div>

                <!-- Form -->
                <div class="md:col-span-2 space-y-6">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            Full Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ Auth::user()->username }}"
                            class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-purple-500 outline-none"
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ Auth::user()->email }}"
                            class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-purple-500 outline-none"
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            New Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak ingin mengganti"
                            class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-purple-500 outline-none"
                        >
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-2">
                            Confirm Password
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-purple-500 outline-none"
                        >
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-lg font-medium hover:opacity-90 transition"
                        >
                            Update Profile
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection