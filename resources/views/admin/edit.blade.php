@extends('layouts.index')

@section('content')
<div class="w-full max-w-4xl px-3 mx-auto mt-6">
  <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-slate-850 shadow-xl rounded-2xl bg-clip-border">
    <div class="border-black/12.5 rounded-t-2xl border-b p-6 pb-2">
      <h6 class="mb-0 text-xl font-bold dark:text-white">Insert Panitia</h6>
    </div>

    <div class="flex-auto px-6 py-4">
      <form action="{{ route('adminUpdate', $panitia['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="name" class=" block text-sm font-medium text-slate-700 dark:text-white">Nama</label>
          <input type="text" name="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $panitia['name'] }}" required>
          </div>

          <div class="mb-3">
              <label for="email" class=" block text-sm font-medium text-slate-700 dark:text-white">Email</label>
              <input type="email" name="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $panitia['email'] }}" readonly>
          </div>

          <div class="mb-3">
              <label for="password" class=" block text-sm font-medium text-slate-700 dark:text-white">password</label>
              <input type="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required >
          </div>

          <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Divisi</label>
            <select name="divisi" id="divisi" class="form-select">
              <optgroup label="Panitia Event">
                  <option value="acara" {{ $panitia['divisi'] == 'acara' ? 'selected' : '' }}>Acara</option>
                  <option value="dokumentasi" {{ $panitia['divisi'] == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                  <option value="perkap" {{ $panitia['divisi'] == 'perkap' ? 'selected' : '' }}>Perlengkapan</option>
                  <option value="konsumsi" {{ $panitia['divisi'] == 'konsumsi' ? 'selected' : '' }}>Konsumsi</option>
              </optgroup>
              <optgroup label="Panitia Keuangan">
                  <option value="keuangan" {{ $panitia['divisi'] == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
              </optgroup>
            </select>
            </div>

          <div class="d-flex justify-content-end">
              <a href="{{ route('adminList') }}" class="btn btn-secondary me-2">Batal</a>
              <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          </div>
      </form>
    </div>
  </div> 
</div>
@endsection


