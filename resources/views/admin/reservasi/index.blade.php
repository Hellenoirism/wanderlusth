@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')
@section('page-title', 'Manajemen Reservasi')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div>
            <h2 class="text-2xl font-bold text-white">
                Data Reservasi
            </h2>

            <p class="text-sm text-blue-300">
                Kelola seluruh reservasi pelanggan
            </p>
        </div>

        <a href="{{ route('admin.reservasi.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-xl shadow hover:bg-indigo-700 transition">

            <b>+ Tambah Reservasi</b>

        </a>

    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="text-sm text-green-400 bg-green-500/10 border border-green-500/20 p-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="text-sm text-red-400 bg-red-500/10 border border-red-500/20 p-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <x-admin.table>

        @if($reservasis->count())

            <x-admin.table-core>

                <x-admin.thead>

                    <x-admin.th>
                        Pelanggan
                    </x-admin.th>

                    <x-admin.th>
                        Armada & Tujuan
                    </x-admin.th>

                    <x-admin.th align="center">
                        Jadwal
                    </x-admin.th>

                    <x-admin.th align="center">
                        Status
                    </x-admin.th>

                    <x-admin.th align="center">
                        Pembayaran
                    </x-admin.th>

                    <x-admin.th align="center">
                        Aksi
                    </x-admin.th>

                </x-admin.thead>

                <x-admin.tbody>

                    @foreach($reservasis as $reservasi)

                    <x-admin.tr>

                        {{-- PELANGGAN --}}
                        <x-admin.td>

                            <p class="font-semibold text-slate-900">
                                {{ optional($reservasi->pelanggan)->nama }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ optional($reservasi->pelanggan)->no_hp }}
                            </p>

                        </x-admin.td>

                        {{-- ARMADA --}}
                        <x-admin.td>

                            <p class="font-semibold text-slate-900">
                                {{ optional($reservasi->armada)->jenis_kendaraan }}
                            </p>

                            <p class="text-xs text-indigo-500">
                                {{ $reservasi->tujuan }}
                            </p>

                            <p class="text-xs text-slate-500">
                                Kapasitas :
                                {{ optional($reservasi->armada)->kapasitas }}
                                Orang
                            </p>

                        </x-admin.td>

                        {{-- JADWAL --}}
                        <x-admin.td align="center">

                            <p class="font-semibold text-slate-900">
                                {{ $reservasi->formatted_tanggal }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ $reservasi->formatted_waktu }}
                            </p>

                        </x-admin.td>

                        {{-- STATUS --}}
                        <x-admin.td align="center">

                            <span class="
                                inline-flex items-center
                                px-3 py-1
                                rounded-full
                                text-xs font-semibold
                                {{ $reservasi->status_badge }}
                            ">
                                {{ $reservasi->status_label }}
                            </span>

                        </x-admin.td>

                        {{-- PEMBAYARAN --}}
                        <x-admin.td align="center">

                            <span class="
                                inline-flex items-center
                                px-3 py-1
                                rounded-full
                                text-xs font-semibold
                                {{ $reservasi->payment_badge }}
                            ">
                                {{ $reservasi->payment_status }}
                            </span>

                        </x-admin.td>

                        {{-- AKSI --}}
                        <x-admin.td align="center">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.reservasi.show', $reservasi) }}">
                                    <x-admin.button>
                                        Detail
                                    </x-admin.button>
                                </a>

                                @if(!$reservasi->pembayaran && !$reservasi->isCancelled())

                                    <a href="{{ route('admin.pembayaran.create', $reservasi) }}">
                                        <x-admin.button variant="primary">
                                            Bayar
                                        </x-admin.button>
                                    </a>

                                @endif

                            </div>

                        </x-admin.td>

                    </x-admin.tr>

                    @endforeach

                </x-admin.tbody>

            </x-admin.table-core>

            {{-- PAGINATION --}}
            <div class="mt-4">
                {{ $reservasis->links() }}
            </div>

        @else

            <x-admin.empty>
                Belum ada data reservasi
            </x-admin.empty>

        @endif

    </x-admin.table>

</div>

@endsection