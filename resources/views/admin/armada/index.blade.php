@extends('admin.layouts.app')

@section('title', 'Manajemen Armada')
@section('page-title', 'Manajemen Armada')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white">Data Armada</h2>
            <p class="text-sm text-blue-300">Kelola semua armada kendaraan</p>
        </div>

        <a href="{{ route('admin.armada.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-xl shadow hover:bg-indigo-700 transition">
            + Tambah Armada
        </a>
    </div>

    <x-admin.table>

        @if($armadas->count())
    
            <x-admin.table-core>
    
                <x-admin.thead>
                    <x-admin.th>Armada</x-admin.th>
                    <x-admin.th align="center">Kapasitas</x-admin.th>
                    <x-admin.th align="center">Harga Sewa</x-admin.th>
                    <x-admin.th align="center">Aksi</x-admin.th>
                </x-admin.thead>
    
                <x-admin.tbody>
    
                    @foreach ($armadas as $armada)
    
                    <x-admin.tr>
    
                        <x-admin.td>
                            <p class="font-semibold text-slate-900">
                                {{ $armada->jenis_kendaraan }}
                            </p>
                            <p class="text-xs text-indigo-500">
                                ID Armada: #{{ $armada->id_armada }}
                            </p>
                        </x-admin.td>
    
                        <x-admin.td align="center">
                            <x-admin.badge>
                                {{ $armada->kapasitas }} Seat
                            </x-admin.badge>
                        </x-admin.td>
    
                        <x-admin.td align="center">
                            <p class="font-semibold text-slate-900">
                                Rp {{ number_format($armada->harga_sewa, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-500">
                                per perjalanan
                            </p>
                        </x-admin.td>
    
                        <x-admin.td align="center">
                            <div class="flex justify-center gap-2">
    
                                <a href="{{ route('admin.armada.edit', $armada) }}">
                                    <x-admin.button>Edit</x-admin.button>
                                </a>
    
                                <form method="POST" action="{{ route('admin.armada.destroy', $armada) }}">
                                    @csrf
                                    @method('DELETE')
    
                                    <x-admin.button variant="danger">
                                        Hapus
                                    </x-admin.button>
                                </form>
    
                            </div>
                        </x-admin.td>
    
                    </x-admin.tr>
    
                    @endforeach
    
                </x-admin.tbody>
    
            </x-admin.table-core>
    
        @else
    
            <x-admin.empty>
                Belum ada data armada
            </x-admin.empty>
    
        @endif
    
    </x-admin.table>
@endsection