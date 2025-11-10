<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    return view('index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('events', AdminEventController::class)->except(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::get('/events', [AdminEventController::class, 'index'])->name('events');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [AdminEventController::class, 'show'])->name('events.show');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    Route::get('/users', function () {
        $users = \App\Models\User::where('role', 'user')
            ->withCount('registrations')
            ->latest()
            ->get();
        return view('admin.users.index', compact('users'));
    })->name('users');

    Route::get('/registrations', function () {
        $registrations = \App\Models\Registration::with(['user', 'event'])
            ->latest()
            ->get();
        $confirmed = \App\Models\Registration::where('status', 'confirmed')->count();
        $pending = \App\Models\Registration::where('status', 'pending')->count();
        $cancelled = \App\Models\Registration::where('status', 'cancelled')->count();
        $total = \App\Models\Registration::count();

        return view('admin.registrations.index', compact('registrations', 'confirmed', 'pending', 'cancelled', 'total'));
    })->name('registrations');

    Route::get('/reports', function () {
        $totalEvents = \App\Models\Event::count();
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        $totalRegistrations = \App\Models\Registration::count();
        $totalRevenue = \App\Models\Registration::where('payment_status', 'paid')->sum('amount');

        return view('admin.reports.index', compact('totalEvents', 'totalUsers', 'totalRegistrations', 'totalRevenue'));
    })->name('reports');

    Route::get('/settings', function () {
        return view('admin.settings.index');
    })->name('settings');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [AdminProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile/avatar', [AdminProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/events', [UserEventController::class, 'index'])->name('events');
    Route::get('/events/{id}', [UserEventController::class, 'show'])->name('events.show');
    Route::post('/events/{id}/register', [UserEventController::class, 'register'])->name('events.register');
    Route::post('/events/favorite', [UserEventController::class, 'toggleFavorite'])->name('events.favorite');

    Route::get('/my-events', [UserEventController::class, 'myEvents'])->name('my-events');
    Route::get('/favorites', [UserEventController::class, 'favorites'])->name('favorites');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile/avatar', [UserProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/forgot-password', function () {
    return redirect()->route('login')->with('info', 'coming soon.');
})->name('password.request');
