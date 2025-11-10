@extends('layouts.user')

@section('title', 'Browse Events')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Browse Events</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Browse Events</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5>Filters</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('user.events') }}">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            <option value="technology" {{ request('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                            <option value="business" {{ request('category') == 'business' ? 'selected' : '' }}>Business</option>
                            <option value="workshop" {{ request('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="conference" {{ request('category') == 'conference' ? 'selected' : '' }}>Conference</option>
                            <option value="seminar" {{ request('category') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="networking" {{ request('category') == 'networking' ? 'selected' : '' }}>Networking</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price Range</label>
                        <select class="form-select" name="price_range" onchange="this.form.submit()">
                            <option value="">All Prices</option>
                            <option value="free" {{ request('price_range') == 'free' ? 'selected' : '' }}>Free</option>
                            <option value="0-100000" {{ request('price_range') == '0-100000' ? 'selected' : '' }}>Under Rp 100.000</option>
                            <option value="100000-500000" {{ request('price_range') == '100000-500000' ? 'selected' : '' }}>Rp 100.000 - Rp 500.000</option>
                            <option value="500000+" {{ request('price_range') == '500000+' ? 'selected' : '' }}>Above Rp 500.000</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Event Type</label>
                        <select class="form-select" name="type" onchange="this.form.submit()">
                            <option value="">All Types</option>
                            <option value="online" {{ request('type') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ request('type') == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ request('type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                    <a href="{{ route('user.events') }}" class="btn btn-secondary w-100">Reset Filters</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        @if($events->count() > 0)
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($event->price == 0)
                        <div class="ribbon ribbon-success">FREE</div>
                    @endif
                    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/application/img-prod-' . (($loop->index % 6) + 1) . '.jpg') }}" class="card-img-top" alt="event" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light-primary">{{ ucfirst($event->category) }}</span>
                            @if(in_array($event->id, $userFavorites))
                                <form action="{{ route('user.events.favorite') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit" class="btn btn-icon p-0" title="Remove from favorites" style="color: #dc3545;">
                                        <i class="ti ti-heart-filled" style="color: #dc3545; font-size: 1.2rem;"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.events.favorite') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit" class="btn btn-icon p-0 border-0 bg-transparent" title="Add to favorites" style="color: #6c757d;">
                                        <i class="ti ti-heart" style="color: #6c757d; font-size: 1.2rem;"></i>
                                    </button>
                                </form>
                            @endif
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
            <i class="ti ti-calendar-off text-muted" style="font-size: 48px;"></i>
            <h5 class="mt-3">No Events Found</h5>
            <p class="text-muted">Try adjusting your filters</p>
        </div>
        @endif
    </div>
</div>
@endsection
