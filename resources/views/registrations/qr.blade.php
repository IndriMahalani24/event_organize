@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-2xl font-bold mb-4">QR Code Registrasi</h1>

    <p><strong>Event ID:</strong> {{ $registration->event_id }}</p>
    <p><strong>Status:</strong> {{ $registration->status }}</p>

    <div class="mt-4 text-center">
        <img src="{{ $qrImage }}" alt="QR Code" class="inline-block shadow-xl border p-2 bg-white">
        <p class="mt-2 text-sm text-gray-600">Tunjukkan QR ini saat hadir di acara.</p>
    </div>

    @if (!$registration->payment_proof)
        <a href="{{ route('registrations.upload', $registration->id) }}"
            class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Upload Bukti Pembayaran
        </a>
    @else
        <p class="text-green-600 mt-4">Bukti pembayaran sudah diunggah.</p>
    @endif

</div>
@endsection
