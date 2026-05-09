@extends('admin.layouts.app')

@section('title', 'Manajemen Fasilitas')
@section('page-title', 'Manajemen Fasilitas')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar Fasilitas</h2>
            <p class="text-sm text-blue-300">Kelola data fasilitas armada</p>
        </div>

        <a href="{{ route('admin.fasilitas.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-xl shadow hover:bg-indigo-700 transition">
            + Tambah
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="text-sm text-green-400 bg-green-500/10 border border-green-500/20 p-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <x-admin.table>

        @if($fasilitas->count())

            <x-admin.table-core>

                {{-- HEAD --}}
                <x-admin.thead>
                    <x-admin.th>No</x-admin.th>
                    <x-admin.th>Nama Fasilitas</x-admin.th>
                    <x-admin.th align="center">Aksi</x-admin.th>
                </x-admin.thead>

                {{-- BODY --}}
                <x-admin.tbody>

                    @foreach($fasilitas as $index => $item)

                        <x-admin.tr>

                            {{-- NO --}}
                            <x-admin.td>
                                {{ $index + 1 }}
                            </x-admin.td>

                            {{-- NAMA --}}
                            <x-admin.td>
                                <p class="font-semibold text-slate-900">
                                    {{ $item->nama_fasilitas }}
                                </p>
                            </x-admin.td>

                            {{-- AKSI --}}
                            <x-admin.td align="center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.fasilitas.edit', $item) }}">
                                        <x-admin.button variant="primary">
                                            Edit
                                        </x-admin.button>
                                    </a>

                                    <form action="{{ route('admin.fasilitas.destroy', $item) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus fasilitas ini?')">
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
                Belum ada data fasilitas
            </x-admin.empty>

        @endif

    </x-admin.table>

</div>
@endsection