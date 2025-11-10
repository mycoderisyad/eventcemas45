@extends('layouts.dashboard')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
  <div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h2 class="mb-0">Dashboard</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="text-muted mb-1">Total Events</p>
                <h4 class="mb-0">0</h4>
              </div>
              <div class="avtar avtar-l bg-light-primary">
                <i class="ti ti-calendar text-primary f-24"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="text-muted mb-1">Active Events</p>
                <h4 class="mb-0">0</h4>
              </div>
              <div class="avtar avtar-l bg-light-success">
                <i class="ti ti-check text-success f-24"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="text-muted mb-1">Total Participants</p>
                <h4 class="mb-0">0</h4>
              </div>
              <div class="avtar avtar-l bg-light-warning">
                <i class="ti ti-users text-warning f-24"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="text-muted mb-1">Revenue</p>
                <h4 class="mb-0">Rp 0</h4>
              </div>
              <div class="avtar avtar-l bg-light-info">
                <i class="ti ti-currency-dollar text-info f-24"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5>Welcome to {{ config('app.name') }}</h5>
          </div>
          <div class="card-body">
            <p>Selamat datang di platform manajemen event. Anda dapat mulai mengelola event Anda dari sini.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
  </div>
</div>
<!-- [ Main Content ] end -->
@endsection
