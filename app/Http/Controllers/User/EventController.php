<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::active()->upcoming();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 'free':
                    $query->where('price', 0);
                    break;
                case '0-100000':
                    $query->whereBetween('price', [1, 100000]);
                    break;
                case '100000-500000':
                    $query->whereBetween('price', [100000, 500000]);
                    break;
                case '500000+':
                    $query->where('price', '>', 500000);
                    break;
            }
        }

        $events = $query->withCount('registrations')
            ->get();

        $userFavorites = Auth::user()->favoriteEvents->pluck('id')->toArray();

        return view('user.events.index', compact('events', 'userFavorites'));
    }

    public function show($id)
    {
        $event = Event::with(['registrations'])->findOrFail($id);
        $user = Auth::user();
        
        $similarEvents = Event::active()
            ->upcoming()
            ->where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->take(2)
            ->get();

        $isFavorite = $user->favoriteEvents->contains($event->id);
        $registration = $user->registrations()
            ->where('event_id', $event->id)
            ->where('status', '!=', 'cancelled')
            ->first();
        
        $hasRegistered = $registration !== null;
        $registrationStatus = $registration ? $registration->status : null;

        return view('user.events.show', compact('event', 'similarEvents', 'isFavorite', 'hasRegistered', 'registrationStatus'));
    }

    public function myEvents()
    {
        $user = Auth::user();
        
        $upcomingRegistrations = $user->registrations()
            ->with('event')
            ->whereHas('event', function($q) {
                $q->where('date', '>=', now()->toDateString());
            })
            ->latest()
            ->get();
            
        $pastRegistrations = $user->registrations()
            ->with('event')
            ->whereHas('event', function($q) {
                $q->where('date', '<', now()->toDateString());
            })
            ->latest()
            ->get();

        return view('user.my-events.index', compact('upcomingRegistrations', 'pastRegistrations'));
    }

    public function favorites()
    {
        $user = Auth::user();
        $favoriteEvents = $user->favoriteEvents()
            ->active()
            ->upcoming()
            ->withCount('registrations')
            ->get();

        return view('user.favorites.index', compact('favoriteEvents'));
    }

    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();
        $eventId = $request->event_id;

        if (!$eventId) {
            return redirect()->back()->with('error', 'Event ID is required');
        }

        $favorite = Favorite::where('user_id', $user->id)
            ->where('event_id', $eventId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Removed from favorites';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'event_id' => $eventId,
            ]);
            $message = 'Added to favorites';
        }

        return redirect()->back()->with('success', $message);
    }

    public function register(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        $existing = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already registered for this event');
        }

        if ($event->available_slots <= 0) {
            return redirect()->back()->with('error', 'Event is fully booked');
        }

        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => $event->price > 0 ? 'pending' : 'confirmed',
            'payment_status' => $event->price > 0 ? 'unpaid' : 'paid',
            'amount' => $event->price,
        ]);

        return redirect()->route('user.my-events')
            ->with('success', 'Successfully registered for the event');
    }
}
