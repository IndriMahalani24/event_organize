@extends('layouts.index')

@section('content')
<div class="w-full max-w-4xl px-3 mx-auto mt-6">
  <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-slate-850 shadow-xl rounded-2xl bg-clip-border">
    <div class="border-black/12.5 rounded-t-2xl border-b p-6 pb-2">
      <h6 class="mb-0 text-xl font-bold dark:text-white">Insert Panitia</h6>
    </div>

    <div class="flex-auto px-6 py-4">
      <form action="{{ route('eventStore') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-slate-700 dark:text-white">Nama Event</label>
          <input type="text" name="judul" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-slate-700 dark:text-white">Deskripsi</label>
          <input type="text" name="description" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4"> 
          <label for="password" class="block text-sm font-medium text-slate-700 dark:text-white">Lokasi</label>
          <input type="text" name="location" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Max Peserta</label>
            <input type="number" name="max_participants" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Status</label>
            <input type="text" name="status" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Pembicara</label>
            <input type="text" name="speaker" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Tanggal Event</label>
            <input type="date" name="event_date" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Jam Event</label>
            <input type="time" name="event_time" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <input type="hidden" name="users_iduser" value="{{ Auth::user()->id }}">
        <div class="mt-6">
          <input type="submit" class="inline-block w-full px-6 py-3 mb-0 text-sm font-bold text-center text-white uppercase align-middle transition-all 
          bg-gradient-to-tr from-blue-600 to-blue-400 rounded-lg shadow-md hover:shadow-lg hover:scale-[1.01] focus:outline-none">Simpan</input>
        </div>
      </form>
    </div>
  </div> 
</div>
@endsection
