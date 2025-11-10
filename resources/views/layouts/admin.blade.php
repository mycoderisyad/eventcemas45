<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Admin Dashboard') - EventCemas</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
    
    @stack('styles')
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ url('/') }}" class="b-brand text-primary">
                    <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="logo image" class="logo-lg">
                    <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">Admin</span>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Dashboard</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.dashboard') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Management</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.events') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar-event"></i></span>
                            <span class="pc-mtext">Events</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.users') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Users</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.registrations') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-ticket"></i></span>
                            <span class="pc-mtext">Registrations</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.reports') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-analytics"></i></span>
                            <span class="pc-mtext">Reports</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Settings</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.settings') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-bell"></i>
                            @php
                                $notificationsCount = \App\Models\Registration::where('created_at', '>=', now()->subDays(7))->count();
                            @endphp
                            @if($notificationsCount > 0)
                                <span class="badge bg-success pc-h-badge">{{ $notificationsCount }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notifications</h5>
                            </div>
                            <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                                @php
                                    $recentRegistrations = \App\Models\Registration::with(['user', 'event'])
                                        ->latest()
                                        ->take(5)
                                        ->get();
                                @endphp
                                @if($recentRegistrations->count() > 0)
                                    <p class="text-span">Recent</p>
                                    @foreach($recentRegistrations as $registration)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <i class="ti ti-user-plus text-primary"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <span class="float-end text-sm text-muted">{{ $registration->created_at->diffForHumans() }}</span>
                                                    <h6 class="text-body mb-2">New Registration</h6>
                                                    <p class="mb-0">{{ $registration->user->name }} registered for {{ $registration->event->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-3">
                                        <p class="text-muted">No notifications</p>
                                    </div>
                                @endif
                            </div>
                            <div class="text-center py-2">
                                <a href="{{ route('admin.registrations') }}" class="link-primary">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="user-image" class="user-avtar">
                            @else
                                <div class="avtar avtar-s bg-light-danger">
                                    <span>{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                </div>
                            @endif
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex mb-1">
                                    <div class="flex-shrink-0">
                                        @if(auth()->user()->avatar)
                                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="user-image" class="user-avtar wid-35">
                                        @else
                                            <div class="avtar avtar-s bg-light-danger">
                                                <span>{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ auth()->user()->name }}</h6>
                                        <span>Administrator</span>
                                    </div>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="pc-head-link bg-transparent border-0 p-0" style="cursor: pointer;">
                                            <i class="ti ti-power text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="drp-t1" data-bs-toggle="tab" data-bs-target="#drp-tab-1" type="button" role="tab" aria-controls="drp-tab-1" aria-selected="true">
                                        <i class="ti ti-user"></i> Profile
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="drp-t2" data-bs-toggle="tab" data-bs-target="#drp-tab-2" type="button" role="tab" aria-controls="drp-tab-2" aria-selected="false">
                                        <i class="ti ti-settings"></i> Setting
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                        <i class="ti ti-edit-circle"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>View Profile</span>
                                    </a>
                                    <a href="{{ route('admin.events') }}" class="dropdown-item">
                                        <i class="ti ti-calendar-event"></i>
                                        <span>My Events</span>
                                    </a>
                                    <a href="{{ route('admin.reports') }}" class="dropdown-item">
                                        <i class="ti ti-file-analytics"></i>
                                        <span>Reports</span>
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-help"></i>
                                        <span>Support</span>
                                    </a>
                                    <a href="{{ route('admin.settings') }}" class="dropdown-item">
                                        <i class="ti ti-settings"></i>
                                        <span>Account Settings</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-lock"></i>
                                        <span>Privacy Center</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-messages"></i>
                                        <span>Feedback</span>
                                    </a>
                                    <a href="{{ route('admin.reports') }}" class="dropdown-item">
                                        <i class="ti ti-list"></i>
                                        <span>History</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header Topbar ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col my-1">
                    <p class="m-0">EventCemas Admin &copy; {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Required Js -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
