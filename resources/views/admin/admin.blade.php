@extends('layouts.index')

@section('content')


<!-- Content -->
<div class="w-full max-w-4xl px-3 mx-auto mt-6">
  <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-slate-850 shadow-xl rounded-2xl bg-clip-border">
    <div class="border-black/12.5 rounded-t-2xl border-b p-6 pb-2">
      <h6 class="mb-0 text-xl font-bold dark:text-white">Insert Panitia</h6>
    </div>

    <div class="flex-auto px-6 py-4">
      <h3>Panitia Event</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($eventPanitia)
                        @foreach ($eventPanitia as $user)
                        <tr>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['divisi'] }}</td>
                            <td>
                                <a href="{{ route('adminEdit', $user['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('adminDestroy', $user['id']) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4">Data tidak tersedia</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <h3 class="mt-5">Panitia Keuangan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($eventPanitia)
                        @foreach ($keuanganPanitia as $user)
                        <tr>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['divisi'] }}</td>
                            <td>
                                <a href="{{ route('adminEdit', $user['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('adminDestroy', $user['id']) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4">Data tidak tersedia</td>
                    </tr>
                    @endif
                </tbody>
            </table>

  </div> 
</div>

@endsection
