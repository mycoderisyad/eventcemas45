@extends('layouts.user')

@section('title', 'Event Details')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.events') }}">Browse Events</a></li>
                    <li class="breadcrumb-item" aria-current="page">Event Details</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/application/img-prod-1.jpg') }}" class="card-img-top" alt="event" style="height: 400px; object-fit: cover;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-light-primary">{{ ucfirst($event->category) }}</span>
                    @if($isFavorite)
                        <form action="{{ route('user.events.favorite') }}" method="POST" class="d-inline" id="favoriteForm">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button type="submit" class="btn btn-icon" title="Remove from favorites" style="color: #dc3545;">
                                <i class="ti ti-heart-filled f-20" style="color: #dc3545;"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('user.events.favorite') }}" method="POST" class="d-inline" id="favoriteForm">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button type="submit" class="btn btn-icon border-0 bg-transparent p-0" title="Add to favorites" style="color: #6c757d;">
                                <i class="ti ti-heart f-20" style="color: #6c757d;"></i>
                            </button>
                        </form>
                    @endif
                </div>

                <h2 class="mb-3">{{ $event->name }}</h2>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-calendar"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-muted">Date</p>
                                <h6 class="mb-0">{{ $event->date->format('d F Y') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-success">
                                    <i class="ti ti-clock"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-muted">Time</p>
                                <h6 class="mb-0">{{ date('g:i A', strtotime($event->time)) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-warning">
                                    <i class="ti ti-map-pin"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-muted">Location</p>
                                <h6 class="mb-0">{{ $event->location }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-info">
                                    <i class="ti ti-users"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-muted">Available Slots</p>
                                <h6 class="mb-0">{{ $event->available_slots }} / {{ $event->capacity }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mb-3">About This Event</h5>
                <p class="text-muted">{{ $event->description }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($event->price == 0)
                        <h3 class="text-success mb-3">FREE</h3>
                    @else
                        <h3 class="text-primary mb-3">Rp {{ number_format($event->price, 0, ',', '.') }}</h3>
                    @endif
                    
                    @if($hasRegistered)
                        @if($registrationStatus == 'confirmed')
                            <button class="btn btn-success btn-lg" disabled>
                                <i class="ti ti-check me-2"></i> Confirmed
                            </button>
                        @elseif($registrationStatus == 'pending')
                            <button class="btn btn-warning btn-lg" disabled>
                                <i class="ti ti-clock me-2"></i> Pending
                            </button>
                        @else
                            <button class="btn btn-success btn-lg" disabled>
                                <i class="ti ti-check me-2"></i> Already Registered
                            </button>
                        @endif
                    @elseif($event->available_slots <= 0)
                        <button class="btn btn-danger btn-lg" disabled>
                            <i class="ti ti-x me-2"></i> Fully Booked
                        </button>
                    @else
                        <form action="{{ route('user.events.register', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="ti ti-ticket me-2"></i> Register Now
                            </button>
                        </form>
                    @endif
                </div>

                <hr class="my-3">

                <h6 class="mb-3">Event Tags</h6>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light-primary">{{ ucfirst($event->category) }}</span>
                    <span class="badge bg-light-info">{{ ucfirst($event->type) }}</span>
                </div>

                @if($similarEvents->count() > 0)
                <h6 class="mb-3 mt-4">Similar Events</h6>
                @foreach($similarEvents as $similarEvent)
                <div class="card shadow-none border mb-2">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ $similarEvent->image ? asset('storage/' . $similarEvent->image) : asset('assets/images/application/img-prod-1.jpg') }}" alt="event" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0 text-sm">{{ $similarEvent->name }}</h6>
                                <small class="text-muted">
                                    @if($similarEvent->price == 0)
                                        FREE
                                    @else
                                        Rp {{ number_format($similarEvent->price, 0, ',', '.') }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
