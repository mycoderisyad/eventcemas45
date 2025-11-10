@extends('layouts.user')

@section('title', 'My Registrations')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">My Registrations</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">My Registrations</h2>
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs profile-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#upcoming" role="tab" aria-selected="true">
                            <i class="ti ti-calendar-event me-2"></i> Upcoming ({{ $upcomingRegistrations->count() }})
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#past" role="tab" aria-selected="false">
                            <i class="ti ti-history me-2"></i> Past Events ({{ $pastRegistrations->count() }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="upcoming" role="tabpanel">
                        @if($upcomingRegistrations->count() > 0)
                        <div class="row">
                            @foreach($upcomingRegistrations as $registration)
                            <div class="col-md-6">
                                <div class="card shadow-none border mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $registration->event->image ? asset('storage/' . $registration->event->image) : asset('assets/images/application/img-prod-1.jpg') }}" alt="event" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-2">{{ $registration->event->name }}</h5>
                                                <p class="text-muted mb-1">
                                                    <i class="ti ti-calendar me-1"></i> {{ $registration->event->date->format('d M Y') }} • {{ date('g:i A', strtotime($registration->event->time)) }}
                                                </p>
                                                <p class="text-muted mb-1">
                                                    <i class="ti ti-map-pin me-1"></i> {{ $registration->event->location }}
                                                </p>
                                                @if($registration->status == 'confirmed')
                                                    <span class="badge bg-success">Confirmed</span>
                                                @elseif($registration->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('user.events.show', $registration->event->id) }}" class="btn btn-sm btn-primary flex-grow-1">
                                                <i class="ti ti-eye me-1"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="ti ti-calendar-off text-muted" style="font-size: 48px;"></i>
                            <h5 class="mt-3">No Upcoming Events</h5>
                            <p class="text-muted">You haven't registered for any upcoming events</p>
                            <a href="{{ route('user.events') }}" class="btn btn-primary">Browse Events</a>
                        </div>
                        @endif
                    </div>

                    <div class="tab-pane" id="past" role="tabpanel">
                        @if($pastRegistrations->count() > 0)
                        <div class="row">
                            @foreach($pastRegistrations as $registration)
                            <div class="col-md-6">
                                <div class="card shadow-none border mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $registration->event->image ? asset('storage/' . $registration->event->image) : asset('assets/images/application/img-prod-1.jpg') }}" alt="event" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-2">{{ $registration->event->name }}</h5>
                                                <p class="text-muted mb-1">
                                                    <i class="ti ti-calendar me-1"></i> {{ $registration->event->date->format('d M Y') }}
                                                </p>
                                                <p class="text-muted mb-1">
                                                    <i class="ti ti-map-pin me-1"></i> {{ $registration->event->location }}
                                                </p>
                                                <span class="badge bg-secondary">Completed</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('user.events.show', $registration->event->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                                <i class="ti ti-eye me-1"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="ti ti-history text-muted" style="font-size: 48px;"></i>
                            <h5 class="mt-3">No Past Events</h5>
                            <p class="text-muted">You haven't attended any past events</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


