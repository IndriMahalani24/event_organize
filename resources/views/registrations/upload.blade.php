@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow mt-6 rounded">
    <h1 class="text-xl font-bold mb-4">Upload Bukti Pembayaran</h1>

    <form action="{{ route('registrations.upload.submit', $registration->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="proof" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
              file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-4" required>

        @error('proof')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Upload
        </button>
    </form>
</div>
@endsection
