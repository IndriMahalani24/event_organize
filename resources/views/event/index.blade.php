@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar Event Saya</h2>
        <a href="{{ route('panitia.event.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Event</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-2 border-b">Judul</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Waktu</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr class="text-sm text-gray-800 hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $event['title'] }}</td>
                        <td class="px-4 py-2 border-b">{{ $event['event_date'] }}</td>
                        <td class="px-4 py-2 border-b">{{ $event['event_time'] }}</td>
                        <td class="px-4 py-2 border-b capitalize">{{ $event['status'] }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                            <a href="{{ route('panitia.event.edit', $event['id']) }}" class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('panitia.event.destroy', $event['id']) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada event.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
