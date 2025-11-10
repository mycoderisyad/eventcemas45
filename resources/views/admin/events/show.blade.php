@extends('layouts.admin')

@section('title', 'Event Details')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.events') }}">Events</a></li>
                    <li class="breadcrumb-item" aria-current="page">Event Details</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Event Details</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/application/img-prod-1.jpg') }}" alt="event" class="img-fluid rounded mb-3">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>{{ $event->name }}</h3>
                    @if($event->status == 'active')
                        <span class="badge bg-success">Active</span>
                    @elseif($event->status == 'draft')
                        <span class="badge bg-secondary">Draft</span>
                    @elseif($event->status == 'completed')
                        <span class="badge bg-info">Completed</span>
                    @else
                        <span class="badge bg-danger">Cancelled</span>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-2"><i class="ti ti-calendar me-2"></i> <strong>Date:</strong> {{ $event->date->format('d F Y') }}</p>
                        <p class="text-muted mb-2"><i class="ti ti-clock me-2"></i> <strong>Time:</strong> {{ date('g:i A', strtotime($event->time)) }}</p>
                        <p class="text-muted mb-2"><i class="ti ti-map-pin me-2"></i> <strong>Location:</strong> {{ $event->location }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-2"><i class="ti ti-tag me-2"></i> <strong>Category:</strong> {{ ucfirst($event->category) }}</p>
                        <p class="text-muted mb-2"><i class="ti ti-currency-dollar me-2"></i> <strong>Price:</strong> Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                        <p class="text-muted mb-2"><i class="ti ti-users me-2"></i> <strong>Capacity:</strong> {{ $event->capacity }} attendees</p>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Description</h5>
                <p class="text-muted">{{ $event->description }}</p>

                <div class="mt-4">
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">
                        <i class="ti ti-edit me-1"></i> Edit Event
                    </a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="ti ti-trash me-1"></i> Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Event Statistics</h5>
            </div>
            <div class="card-body">
                @php
                    $registrationCount = $event->registration_count ?? $event->registrations()->where('status', '!=', 'cancelled')->count();
                    $confirmedCount = $event->registrations()->where('status', 'confirmed')->count();
                    $pendingCount = $event->registrations()->where('status', 'pending')->count();
                    $revenue = $event->revenue ?? $event->registrations()->where('payment_status', 'paid')->sum('amount');
                    $percentage = $event->capacity > 0 ? ($registrationCount / $event->capacity) * 100 : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Registrations</span>
                        <span class="text-primary fw-bold">{{ $registrationCount }} / {{ $event->capacity }}</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="text-muted mb-1">Total Revenue</p>
                    <h4 class="mb-0">Rp {{ number_format($revenue, 0, ',', '.') }}</h4>
                </div>

                <div class="mb-3">
                    <p class="text-muted mb-1">Confirmed</p>
                    <h5 class="mb-0">{{ $confirmedCount }} attendees</h5>
                </div>

                <div class="mb-3">
                    <p class="text-muted mb-1">Pending</p>
                    <h5 class="mb-0">{{ $pendingCount }} attendees</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Registrations</h5>
            </div>
            <div class="card-body">
                @if($event->registrations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Participant</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($event->registrations->take(10) as $registration)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-primary">
                                                <span>{{ strtoupper(substr($registration->user->name, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $registration->user->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $registration->user->email }}</td>
                                <td>{{ $registration->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($registration->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($registration->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    @if($registration->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-warning">Unpaid</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-3">
                    <p class="text-muted">No registrations yet</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
