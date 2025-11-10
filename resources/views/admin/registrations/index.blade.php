@extends('layouts.admin')

@section('title', 'Registrations Management')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Registrations</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Event Registrations</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-success">
                            <i class="ti ti-check text-success f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Confirmed</h6>
                        <h3 class="mb-0">{{ number_format($confirmed) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-warning">
                            <i class="ti ti-clock text-warning f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Pending</h6>
                        <h3 class="mb-0">{{ number_format($pending) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-danger">
                            <i class="ti ti-x text-danger f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Cancelled</h6>
                        <h3 class="mb-0">{{ number_format($cancelled) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-primary">
                            <i class="ti ti-ticket text-primary f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total</h6>
                        <h3 class="mb-0">{{ number_format($total) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>All Registrations</h5>
            </div>
            <div class="card-body">
                @if($registrations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Registration ID</th>
                                <th>Participant</th>
                                <th>Event</th>
                                <th>Registration Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $registration)
                            <tr>
                                <td>#REG{{ str_pad($registration->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-primary">
                                                <span>{{ strtoupper(substr($registration->user->name, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $registration->user->name }}</h6>
                                            <small class="text-muted">{{ $registration->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $registration->event->name }}</td>
                                <td>{{ $registration->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="d-block fw-bold">Rp {{ number_format($registration->amount, 0, ',', '.') }}</span>
                                    @if($registration->payment_status == 'paid')
                                        <small class="text-success">Paid</small>
                                    @elseif($registration->payment_status == 'unpaid')
                                        <small class="text-warning">Unpaid</small>
                                    @else
                                        <small class="text-danger">Refunded</small>
                                    @endif
                                </td>
                                <td>
                                    @if($registration->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($registration->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-icon btn-link-secondary" title="View">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="ti ti-ticket-off text-muted" style="font-size: 48px;"></i>
                    <h5 class="mt-3">No Registrations Found</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
