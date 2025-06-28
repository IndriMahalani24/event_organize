@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-white">Daftar Event</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($events as $event)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
                <p class="text-sm text-gray-600">{{ $event->event_date }}</p>
                <a href="{{ route('events.show', $event->id) }}"
                   class="text-blue-600 hover:underline block mt-2">Lihat Detail</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
