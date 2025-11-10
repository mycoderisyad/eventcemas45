<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $events = Event::all();

        if ($users->count() > 0 && $events->count() > 0) {
            foreach ($users->take(3) as $user) {
                foreach ($events->random(2) as $event) {
                    Registration::create([
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                        'status' => fake()->randomElement(['pending', 'confirmed', 'confirmed']),
                        'payment_status' => fake()->randomElement(['paid', 'paid', 'unpaid']),
                        'amount' => $event->price,
                    ]);
                }
            }
        }
    }
}
