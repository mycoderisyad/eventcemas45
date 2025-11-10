@extends('layouts.admin')

@section('title', 'Events Management')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Events</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Events Management</h2>
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">All Events</h5>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Create Event
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($events->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Capacity</th>
                                <th>Registrations</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/application/img-prod-1.jpg') }}" alt="event" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $event->name }}</h6>
                                            <p class="text-muted mb-0 text-sm">{{ ucfirst($event->category) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="d-block">{{ $event->date->format('d M Y') }}</span>
                                    <small class="text-muted">{{ date('g:i A', strtotime($event->time)) }}</small>
                                </td>
                                <td>{{ $event->location }}</td>
                                <td><span class="badge bg-light-primary">{{ ucfirst($event->category) }}</span></td>
                                <td>Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                                <td>{{ $event->capacity }}</td>
                                <td>
                                    @php
                                        $registrationCount = $event->registrations_count ?? $event->registrations()->where('status', '!=', 'cancelled')->count();
                                        $percentage = $event->capacity > 0 ? ($registrationCount / $event->capacity) * 100 : 0;
                                        $progressColor = $percentage >= 80 ? 'danger' : ($percentage >= 50 ? 'warning' : 'success');
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{ $registrationCount }} / {{ $event->capacity }}</span>
                                        <div class="progress w-100" style="height: 6px;">
                                            <div class="progress-bar bg-{{ $progressColor }}" role="progressbar" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
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
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-icon btn-link-secondary" title="View">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-icon btn-link-primary" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-link-danger" title="Delete">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="ti ti-calendar-off text-muted" style="font-size: 48px;"></i>
                    <h5 class="mt-3">No Events Found</h5>
                    <p class="text-muted">Create your first event to get started</p>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Create Event
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
