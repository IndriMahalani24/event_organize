@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Edit Event</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('panitia.event.update', $event['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Judul Event</label>
            <input type="text" name="name" value="{{ $event['name'] }}" class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ $event['description'] }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="location" value="{{ $event['location'] }}" class="w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Jumlah Maksimal Peserta</label>
            <input type="number" name="max_participants" value="{{ $event['max_participants'] }}" class="w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="w-full mt-1 rounded border-gray-300 shadow-sm" required>
                <option value="aktif" {{ $event['status'] === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $event['status'] === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Pemateri</label>
            <input type="text" name="speaker" value="{{ $event['speaker'] }}" class="w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="event_date" value="{{ $event['event_date'] }}" class="w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Waktu</label>
            <input type="time" name="event_time" value="{{ $event['event_time'] }}" class="w-full mt-1 rounded border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="registration_fee">Biaya Pendaftaran</label>
            <input type="number" name="registration_fee" value="{{ $event['registration_fee'] }}" class="form-input">
        </div>

        <div class="mb-4">
            <label for="poster">Poster Baru (Opsional)</label>
            <input type="file" name="poster" class="form-input" accept="image/*">
            @if ($event['poster'])
                <p class="text-sm mt-2">Poster sekarang:</p>
                <img src="{{ asset('posters/' . $event['poster']) }}" alt="Poster" class="h-24">
            @endif
        </div>

        <div class="flex justify-end">
            <a href="{{ route('panitia.event.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Event</button>
        </div>
    </form>
</div>
@endsection
