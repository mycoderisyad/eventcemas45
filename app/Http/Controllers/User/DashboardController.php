<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $myRegistrations = $user->registrations()
            ->whereHas('event', function($q) {
                $q->where('date', '>=', now()->toDateString());
            })
            ->count();
            
        $availableEvents = Event::active()
            ->upcoming()
            ->count();
            
        $favorites = $user->favorites()->count();
        
        $upcomingEvents = $user->registrations()
            ->with('event')
            ->whereHas('event', function($q) {
                $q->where('date', '>=', now()->toDateString());
            })
            ->latest()
            ->take(2)
            ->get();
            
        $recommendedEvents = Event::active()
            ->upcoming()
            ->whereDoesntHave('registrations', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('user.dashboard', compact(
            'myRegistrations',
            'availableEvents',
            'favorites',
            'upcomingEvents',
            'recommendedEvents'
        ));
    }
}
