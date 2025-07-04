@extends('layouts.index')

@section('content')
<div class="w-full max-w-4xl px-3 mx-auto mt-6">
  <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-slate-850 shadow-xl rounded-2xl bg-clip-border">
    <div class="border-black/12.5 rounded-t-2xl border-b p-6 pb-2">
      <h6 class="mb-0 text-xl font-bold dark:text-white">Insert Panitia</h6>
    </div>

    <div class="flex-auto px-6 py-4">
      <form action="{{ route('adminStore') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-slate-700 dark:text-white">Nama</label>
          <input type="text" name="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-slate-700 dark:text-white">Email</label>
          <input type="email" name="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-slate-700 dark:text-white">Password</label>
          <input type="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:bg-slate-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-slate-700 dark:text-white">Divisi</label>
            <select name="divisi" id="divisi" class="form-select">
                <optgroup label="Panitia Event">
                    <option value="acara">Acara</option>
                    <option value="dokumentasi">Dokumentasi</option>
                    <option value="perkap">Perlengkapan</option>
                    <option value="konsumsi">Konsumsi</option>
                </optgroup>
                <optgroup label="Panitia Keuangan">
                    <option value="keuangan">Keuangan</option>
                </optgroup>
            </select>
            </div>

        <input type="hidden" name="role_id" id="role_id" value="2">

        <script>
            document.getElementById('divisi').addEventListener('change', function () {
                const selected = this.value;
                const roleInput = document.getElementById('role_id');

                if (selected === 'keuangan') {
                    roleInput.value = 3;
                } else {
                    roleInput.value = 2;
                }
            });
          </script>


        <div class="mt-6">
          <input type="submit" class="inline-block w-full px-6 py-3 mb-0 text-sm font-bold text-center text-white uppercase align-middle transition-all 
          bg-gradient-to-tr from-blue-600 to-blue-400 rounded-lg shadow-md hover:shadow-lg hover:scale-[1.01] focus:outline-none">Simpan</input>
        </div>
      </form>
    </div>
  </div> 
</div>
@endsection
