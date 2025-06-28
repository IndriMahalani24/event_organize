@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Validasi Pembayaran</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama Peserta</th>
                <th class="p-2 border">Event</th>
                <th class="p-2 border">Bukti Pembayaran</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $index => $reg)
                <tr class="text-center">
                    <td class="p-2 border">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $reg->user_name }}</td>
                    <td class="p-2 border">{{ $reg->event_name }}</td>
                    <td class="p-2 border">
                        <a href="{{ asset('storage/' . $reg->payment_proof) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                    </td>
                    <td class="p-2 border">{{ $reg->status }}</td>
                    <td class="p-2 border">
                        @if($reg->status !== 'lunas')
                        <form method="POST" action="{{ route('finance.approve', $reg->id) }}">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                Setujui
                            </button>
                        </form>
                        @else
                            <span class="text-green-700 font-semibold">Lunas</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
