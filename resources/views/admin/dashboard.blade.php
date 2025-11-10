@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Admin Dashboard</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Admin Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- Total Events Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card bg-primary-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-primary">
                                <i class="ti ti-calendar-event text-primary f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-white">Total Events</h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 rounded mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Events Created</p>
                                <h4 class="mb-0 text-primary">{{ $totalEvents }}</h4>
                            </div>
                            <div>
                                <span class="badge bg-light-success">{{ $activeEvents }} Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card bg-success-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-success">
                                <i class="ti ti-users text-success f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-white">Total Users</h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 rounded mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Registered Users</p>
                                <h4 class="mb-0 text-success">{{ number_format($totalUsers) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Registrations Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card bg-warning-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ti ti-ticket text-warning f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-white">Total Registrations</h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 rounded mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Event Registrations</p>
                                <h4 class="mb-0 text-warning">{{ number_format($totalRegistrations) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-md-6 col-xl-3">
            <div class="card bg-secondary-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-secondary">
                                <i class="ti ti-currency-dollar text-secondary f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-white">Total Revenue</h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 rounded mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">All Time</p>
                                <h4 class="mb-0 text-secondary">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Recent Events Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Events</h5>
            </div>
            <div class="card-body">
                @if($recentEvents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Registrations</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentEvents as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-primary">
                                                <i class="ti ti-calendar-event"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $event->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $event->date->format('d M Y') }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                    @php
                                        $regCount = $event->registrations->count();
                                    @endphp
                                    <span class="badge bg-light-success">{{ $regCount }} / {{ $event->capacity }}</span>
                                </td>
                                <td>
                                    @if($event->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($event->status == 'draft')
                                        <span class="badge bg-secondary">Draft</span>
                                    @elseif($event->status == 'completed')
                                        <span class="badge bg-info">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-icon btn-link-secondary">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-icon btn-link-primary">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-3">
                    <p class="text-muted">No events found</p>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Create First Event
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
