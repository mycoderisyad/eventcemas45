@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Settings</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Settings</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="list-group list-group-flush">
                <a href="#general" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                    <i class="ti ti-settings me-2"></i> General Settings
                </a>
                <a href="#email" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="ti ti-mail me-2"></i> Email Settings
                </a>
                <a href="#payment" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="ti ti-credit-card me-2"></i> Payment Settings
                </a>
                <a href="#notification" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="ti ti-bell me-2"></i> Notifications
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="tab-content">
            <div class="tab-pane show active" id="general">
                <div class="card">
                    <div class="card-header">
                        <h5>General Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Application Name</label>
                                <input type="text" class="form-control" value="EventCemas">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Application Email</label>
                                <input type="email" class="form-control" value="admin@eventcemas.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Application Phone</label>
                                <input type="tel" class="form-control" value="+62 21 1234 5678">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Application Address</label>
                                <textarea class="form-control" rows="3">Jl. Sudirman No. 123, Jakarta Pusat</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Application Logo</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="email">
                <div class="card">
                    <div class="card-header">
                        <h5>Email Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">SMTP Host</label>
                                <input type="text" class="form-control" placeholder="smtp.gmail.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SMTP Port</label>
                                <input type="number" class="form-control" placeholder="587">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SMTP Username</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SMTP Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">From Email</label>
                                <input type="email" class="form-control" value="noreply@eventcemas.com">
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2">Test Connection</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="payment">
                <div class="card">
                    <div class="card-header">
                        <h5>Payment Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="enablePayment" checked>
                                    <label class="form-check-label" for="enablePayment">Enable Online Payment</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Payment Gateway</label>
                                <select class="form-select">
                                    <option value="midtrans">Midtrans</option>
                                    <option value="xendit">Xendit</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Server Key</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Client Key</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="notification">
                <div class="card">
                    <div class="card-header">
                        <h5>Notification Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                    <label class="form-check-label" for="emailNotif">Email Notifications</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="newRegistration" checked>
                                    <label class="form-check-label" for="newRegistration">New Registration Notifications</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="newEvent" checked>
                                    <label class="form-check-label" for="newEvent">New Event Notifications</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paymentNotif" checked>
                                    <label class="form-check-label" for="paymentNotif">Payment Notifications</label>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

