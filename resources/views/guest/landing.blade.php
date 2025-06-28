@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Event RameinApp</h1>

    @forelse ($events as $event)
        <div class="border p-4 rounded-lg shadow mb-4 bg-white">
            <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
            <p class="text-sm text-gray-600">{{ $event->event_date }}</p>
            <p class="mt-1">{{ $event->location }}</p>
            <p class="mt-1 text-gray-700">Pembicara: {{ $event->speaker }}</p>
            <p class="mt-1">Biaya: Rp{{ number_format($event->registration_fee) }}</p>
            <p class="mt-1 text-sm text-green-600">Status: {{ $event->status }}</p>

            <div class="mt-4">
                @auth
                    <a href="{{ route('events.show', $event->id) }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Pesan Tiket
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Pesan Tiket
                    </a>
                @endauth
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500">Tidak ada event yang tersedia saat ini.</p>
    @endforelse
</div>
@endsection
