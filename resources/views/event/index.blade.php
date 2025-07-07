@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar Event Saya</h2>
        <a href="{{ route('panitia.event.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">+ Tambah Event</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($events as $event)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $event['name'] }}</h2>
                <p class="text-sm text-gray-600">{{ $event['event_date'] }}</p>

                {{-- Poster --}}
                @if (!empty($event['poster']))
                    <img src="http://localhost:3000/uploads/{{ $event['poster'] }}" alt="Poster" class="h-24 my-2">
                @endif

                <a href="{{ route('events.show', $event['id']) }}" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 inline-block mb-2">Lihat Detail</a>
                <a href="{{ route('panitia.event.edit', $event['id']) }}" class="text-blue-600 hover:underline mr-2">Edit</a>

                <form action="{{ route('panitia.event.destroy', $event['id']) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-500">
                Belum ada event.
            </div>
        @endforelse
    </div>
</div>
@endsection
