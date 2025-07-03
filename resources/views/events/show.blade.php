@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-4 text-black">{{ $event->name }}</h1>

    <div class="bg-white p-6 rounded shadow">
        <img src="{{ asset('posters/' . $event->poster) }}" alt="Poster" class="h-24">
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y, H:i') }}</p>
        <p><strong>Lokasi:</strong> {{ $event->location }}</p>
        <p><strong>Narasumber:</strong> {{ $event->speaker }}</p>
        <p><strong>Biaya:</strong> Rp{{ number_format($event->registration_fee, 0, ',', '.') }}</p>

        @auth
            @if (auth()->user()->role_id == 4)
                <a href="{{ route('events.order', $event->id) }}"
                   class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Pesan Tiket
                </a>
            @endif
            @if (Auth::user()->role_id == 2) 
                <a href="{{ route('panitia.event.edit', $event->id) }}"
                   class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Edit Event
                </a>
            @endif
        @else
            <p class="mt-4 text-sm text-gray-500">Silakan login untuk mendaftar event.</p>
        @endauth
    </div>
</div>
@endsection
