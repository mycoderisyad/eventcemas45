<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $activeEvents = Event::active()->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalRegistrations = Registration::count();
        $totalRevenue = Registration::where('payment_status', 'paid')->sum('amount');
        
        $recentEvents = Event::with('registrations')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'activeEvents',
            'totalUsers',
            'totalRegistrations',
            'totalRevenue',
            'recentEvents'
        ));
    }
}
