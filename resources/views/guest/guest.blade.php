@extends('layouts.frontend')

@section('title', 'Daftar Event')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-5 fw-bold">Event Mendatang</h1>
    <p class="lead text-muted">Temukan dan ikuti event-event menarik dari Papilaya's University.</p>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse ($event as $events)
      $event =[];
    <div class="col">
        <div class="card h-100 shadow-sm event-card">
            @if($event->poster_path)
                <img src="{{ asset('storage/' . $event->poster_path) }}" class="card-img-top" alt="Poster {{ $event->name }}" style="height: 200px; object-fit: cover;">
            @else
                <div class="d-flex align-items-center justify-content-center" style="height: 200px; background-color: #e9ecef;">
                    <small class="text-muted">Poster Tidak Tersedia</small>
                </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold">{{ $event->name }}</h5>
                <p class="card-text text-muted small mb-2"><i class="fas fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}</p>
                <p class="card-text text-muted small mb-3"><i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}</p>
                <p class="card-text h4 fw-bold text-primary mb-3">
                    {{ $event->registration_fee > 0 ? 'Rp ' . number_format($event->registration_fee, 0, ',', '.') : 'Gratis' }}
                </p>
                <div class="mt-auto">
                     <a href="{{ route('events.show', $event) }}" class="btn btn-primary w-100">Lihat Detail & Daftar</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            Saat ini belum ada event yang tersedia.
        </div>
    </div>
    @endforelse
</div>
@endsection