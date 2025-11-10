@extends('layouts.user')

@section('title', 'Favorite Events')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Favorites</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">My Favorite Events</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@if($favoriteEvents->count() > 0)
<div class="row">
    @foreach($favoriteEvents as $event)
    <div class="col-md-4 mb-4">
        <div class="card">
            @if($event->price == 0)
                <div class="ribbon ribbon-success">FREE</div>
            @endif
            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/application/img-prod-' . (($loop->index % 6) + 1) . '.jpg') }}" class="card-img-top" alt="event" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge bg-light-primary">{{ ucfirst($event->category) }}</span>
                    <form action="{{ route('user.events.favorite') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-icon p-0 border-0" title="Remove from favorites" style="color: #dc3545;">
                            <i class="ti ti-heart-filled" style="color: #dc3545; font-size: 1.2rem;"></i>
                        </button>
                    </form>
                </div>
                <h5 class="card-title">{{ $event->name }}</h5>
                <p class="card-text text-muted">
                    <small><i class="ti ti-calendar me-1"></i> {{ $event->date->format('d M Y') }}</small><br>
                    <small><i class="ti ti-map-pin me-1"></i> {{ $event->location }}</small>
                </p>
                @php
                    $regCount = $event->registrations_count ?? $event->registrations()->where('status', '!=', 'cancelled')->count();
                    $available = $event->capacity - $regCount;
                    $slotColor = $available <= 10 ? 'danger' : ($available <= ($event->capacity * 0.3) ? 'warning' : 'success');
                @endphp
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if($event->price == 0)
                        <span class="text-success fw-bold">FREE</span>
                    @else
                        <span class="text-primary fw-bold">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    @endif
                    <span class="badge bg-light-{{ $slotColor }}">{{ $regCount }}/{{ $event->capacity }} slots</span>
                </div>
                <a href="{{ route('user.events.show', $event->id) }}" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-5">
    <i class="ti ti-heart-off text-muted" style="font-size: 48px;"></i>
    <h5 class="mt-3">No Favorite Events</h5>
    <p class="text-muted">Start adding events to your favorites to see them here</p>
    <a href="{{ route('user.events') }}" class="btn btn-primary">Browse Events</a>
</div>
@endif
@endsection


