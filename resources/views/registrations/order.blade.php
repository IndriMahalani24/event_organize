@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-4 text-white">Konfirmasi Tiket</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Event:</strong> {{ $event->name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y, H:i') }}</p>
        <p><strong>Biaya:</strong> Rp{{ number_format($event->registration_fee, 0, ',', '.') }}</p>

        <form action="{{ route('events.store', $event->id) }}" method="POST">
            @csrf
            <button type="submit"
                class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Konfirmasi & Dapatkan QR
            </button>
        </form>
    </div>
</div>
@endsection
