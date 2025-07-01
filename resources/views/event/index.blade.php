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

    <div class="overflow-x-auto">
                @isset($events)
                    @forelse ($events as $event)
                        <div class="container mx-auto px-4 py-8">
                            <h1 class="text-3xl font-bold mb-6 text-white">Daftar Event</h1>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($events as $event)
                                    <div class="bg-white p-4 rounded shadow">
                                        <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
                                        <p class="text-sm text-gray-600">{{ $event->event_date }}</p>
                                        <a href="{{ route('events.show', $event->id) }}"
                                        class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Lihat Detail</a>
                                        <img src="{{ asset('posters/' . $event->poster) }}" alt="Poster" class="h-24">
                                        <a href="{{ route('panitia.event.edit', $event['id']) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('panitia.event.destroy', $event['id']) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada event.</td>
                        </tr>
                    @endforelse
                @else
                    <tr><td colspan="5">Tidak ada event.</td></tr>
                @endisset
            </tbody>
        </table>
    </div>
</div>
@endsection
