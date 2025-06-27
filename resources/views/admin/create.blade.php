@extends('layouts.index')

@section('content')

<div class="container">
    <h2>Tambah Panitia</h2>

    <form action="{{ route('adminStore') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label for="divisi" class="form-label">Divisi</label>
            <input type="text" class="form-control" name="divisi" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
      <!-- end cards -->
    </main>

@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')

@endsection