@extends('layouts.user')

@section('title', 'My Dashboard')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Welcome back, {{ auth()->user()->name }}!</h2>
                </div>
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

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-primary">
                            <i class="ti ti-ticket text-primary f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">My Registrations</h6>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0">{{ $myRegistrations }}</h3>
                    <p class="text-muted mb-0">Upcoming events</p>
                    <a href="{{ route('user.my-events') }}" class="btn btn-link-primary btn-sm mt-2">View All <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-success">
                            <i class="ti ti-calendar-event text-success f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Available Events</h6>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0">{{ $availableEvents }}</h3>
                    <p class="text-muted mb-0">Events to explore</p>
                    <a href="{{ route('user.events') }}" class="btn btn-link-success btn-sm mt-2">Browse Events <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-danger">
                            <i class="ti ti-heart text-danger f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Favorites</h6>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0">{{ $favorites }}</h3>
                    <p class="text-muted mb-0">Saved events</p>
                    <a href="{{ route('user.favorites') }}" class="btn btn-link-danger btn-sm mt-2">View Favorites <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($upcomingEvents->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>My Upcoming Events</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($upcomingEvents as $registration)
                    <div class="col-md-6">
                        <div class="card shadow-none border mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $registration->event->image ? asset('storage/' . $registration->event->image) : asset('assets/images/application/img-prod-1.jpg') }}" alt="event" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{ $registration->event->name }}</h5>
                                        <p class="text-muted mb-0"><i class="ti ti-calendar me-1"></i>{{ $registration->event->date->format('d M Y') }}</p>
                                        <p class="text-muted mb-0"><i class="ti ti-map-pin me-1"></i>{{ $registration->event->location }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($registration->status == 'confirmed')
                                        <span class="badge bg-light-success">Confirmed</span>
                                    @elseif($registration->status == 'pending')
                                        <span class="badge bg-light-warning">Pending</span>
                                    @else
                                        <span class="badge bg-light-danger">Cancelled</span>
                                    @endif
                                    <a href="{{ route('user.events.show', $registration->event->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($recommendedEvents->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Recommended Events for You</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($recommendedEvents as $event)
                    <div class="col-md-4">
                        <div class="card shadow-none border">
                            @if($event->price == 0)
                                <div class="ribbon ribbon-success">FREE</div>
                            @endif
                            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/application/img-prod-' . (($loop->index % 6) + 1) . '.jpg') }}" class="card-img-top" alt="event" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text text-muted">
                                    <i class="ti ti-calendar me-1"></i>{{ $event->date->format('d M Y') }}<br>
                                    <i class="ti ti-map-pin me-1"></i>{{ $event->location }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($event->price == 0)
                                        <span class="text-success fw-bold">FREE</span>
                                    @else
                                        <span class="text-primary fw-bold">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                    @endif
                                    <a href="{{ route('user.events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
